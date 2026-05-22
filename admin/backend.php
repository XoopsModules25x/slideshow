<?php

/**
 * XOOPS slideshow module — Admin backend
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @version         2.1
 */
require 'header.php';

$op = slideshow_CleanVars($_REQUEST, 'op', 'new', 'string');
xoops_cp_header();

if (empty($_REQUEST)) {
    redirect_header('slideshow.php', 3, _AM_SLIDESHOW_MSG_NOTINFO);
    xoops_cp_footer();
    exit();
}

// ── Güvenli tarih ayrıştırıcı ─────────────────────────────────────────────
// XoopsFormDateTime, POST'a şu iki yapıdan birini gönderir:
//   a) $_POST['field']['date'] = 'YYYY-MM-DD'  ve  ['time'] = saniye cinsinden offset (int)
//   b) $_POST['field'] = unix timestamp (integer)  — bazı XOOPS temalarında
// PHP 8'de strtotime(array) Fatal Error verdiğinden güvenli bir sarmalayıcı kullanıyoruz.
function slideshow_parseDateTime($postValue, $fallback = null)
{
    if ($fallback === null) {
        $fallback = time();
    }

    // Yapı a: array ['date' => ..., 'time' => ...]
    if (is_array($postValue)) {
        $datePart = isset($postValue['date']) ? trim((string)$postValue['date']) : '';
        $timePart = isset($postValue['time']) ? (int)$postValue['time']          : 0;

        if ($datePart === '') {
            return date('Y-m-d H:i:s', $fallback);
        }

        $ts = strtotime($datePart);
        if ($ts === false) {
            return date('Y-m-d H:i:s', $fallback);
        }

        return date('Y-m-d H:i:s', $ts + $timePart);
    }

    // Yapı b: doğrudan timestamp ya da tarih string'i
    if (is_numeric($postValue)) {
        return date('Y-m-d H:i:s', (int)$postValue);
    }

    $ts = strtotime((string)$postValue);
    if ($ts === false) {
        return date('Y-m-d H:i:s', $fallback);
    }

    return date('Y-m-d H:i:s', $ts);
}

// ── İzin verilen item_type değerleri ──────────────────────────────────────
$allowedTypes = ['image', 'youtube', 'vimeo'];

switch ($op) {

    // ── Category: Add ─────────────────────────────────────────────────────
    case 'addcategory':
        $obj = $category_handler->create();
        $obj->setVars($_POST);
        $obj->setVar('category_created', time());

        if (!$category_handler->insert($obj)) {
            xoops_error(implode('<br>', $obj->getErrors()));
            xoops_cp_footer();
            exit();
        }

        redirect_header('category.php', 1, _AM_SLIDESHOW_MSG_INSERTSUCCESS);
        xoops_cp_footer();
        exit();

    // ── Category: Edit ────────────────────────────────────────────────────
    case 'editcategory':
        $category_id = slideshow_CleanVars($_REQUEST, 'category_id', 0, 'int');

        if ($category_id > 0) {
            $obj = $category_handler->get($category_id);
            $obj->setVars($_POST);

            if (!$category_handler->insert($obj)) {
                xoops_error(implode('<br>', $obj->getErrors()));
                xoops_cp_footer();
                exit();
            }
        }

        redirect_header('category.php', 1, _AM_SLIDESHOW_MSG_EDITSUCCESS);
        xoops_cp_footer();
        exit();

    // ── Category: Delete ──────────────────────────────────────────────────
    case 'deletecategory':
        $category_id = slideshow_CleanVars($_REQUEST, 'category_id', 0, 'int');
        $obj         = $category_handler->get($category_id);

        if (!$category_handler->delete($obj)) {
            xoops_error(implode('<br>', $obj->getErrors()));
            xoops_cp_footer();
            exit();
        }

        redirect_header('category.php', 1, _AM_SLIDESHOW_MSG_DELETESUCCESS);
        xoops_cp_footer();
        exit();

    // ── Item: Add ─────────────────────────────────────────────────────────
    case 'additem':
        $obj = $item_handler->create();

        // Temel alanlar
        $obj->setVar('item_title',    slideshow_CleanVars($_POST, 'item_title',    '', 'string'));
        $obj->setVar('item_caption',  slideshow_CleanVars($_POST, 'item_caption',  '', 'string'));
        $obj->setVar('item_category', slideshow_CleanVars($_POST, 'item_category', 0,  'int'));
        $obj->setVar('item_link',     slideshow_CleanVars($_POST, 'item_link',     '', 'string'));
        $obj->setVar('item_linktarget', slideshow_CleanVars($_POST, 'item_linktarget', 0, 'int'));
        $obj->setVar('item_status',   slideshow_CleanVars($_POST, 'item_status',   1,  'int'));
        $obj->setVar('item_order',    slideshow_CleanVars($_POST, 'item_order',    100,'int'));
        $obj->setVar('item_languagecode', slideshow_CleanVars($_POST, 'item_languagecode', '', 'string'));
        $obj->setVar('item_uid',      isset($GLOBALS['xoopsUser']) ? (int)$GLOBALS['xoopsUser']->getVar('uid') : 0);
        $obj->setVar('item_create',   time());

        // item_type
        $itemType = slideshow_CleanVars($_POST, 'item_type', 'image', 'string');
        if (!in_array($itemType, $allowedTypes, true)) {
            $itemType = 'image';
        }
        $obj->setVar('item_type', $itemType);

        // Video URL
        $obj->setVar('item_video_url', slideshow_CleanVars($_POST, 'item_video_url', '', 'string'));

        // Resim yükleme (sadece image tipinde)
        $obj->setVar('item_img', $item_handler->uploadimg(''));

        // Tarihler — PHP 8 güvenli
        $obj->setVar('item_startdate', slideshow_parseDateTime(
            isset($_POST['item_startdate']) ? $_POST['item_startdate'] : null,
            time() - 60
        ));
        $obj->setVar('item_enddate', slideshow_parseDateTime(
            isset($_POST['item_enddate']) ? $_POST['item_enddate'] : null,
            strtotime('+1 year')
        ));

        if (!$item_handler->insert($obj)) {
            xoops_error(implode('<br>', $obj->getErrors()));
            xoops_cp_footer();
            exit();
        }

        redirect_header('slideshow.php', 1, _AM_SLIDESHOW_MSG_INSERTSUCCESS);
        xoops_cp_footer();
        exit();

    // ── Item: Edit ────────────────────────────────────────────────────────
    case 'edititem':
        $item_id = slideshow_CleanVars($_REQUEST, 'item_id', 0, 'int');

        if ($item_id > 0) {
            $obj = $item_handler->get($item_id);

            // Temel alanlar
            $obj->setVar('item_title',    slideshow_CleanVars($_POST, 'item_title',    '', 'string'));
            $obj->setVar('item_caption',  slideshow_CleanVars($_POST, 'item_caption',  '', 'string'));
            $obj->setVar('item_category', slideshow_CleanVars($_POST, 'item_category', 0,  'int'));
            $obj->setVar('item_link',     slideshow_CleanVars($_POST, 'item_link',     '', 'string'));
            $obj->setVar('item_linktarget', slideshow_CleanVars($_POST, 'item_linktarget', 0, 'int'));
            $obj->setVar('item_status',   slideshow_CleanVars($_POST, 'item_status',   1,  'int'));
            $obj->setVar('item_order',    slideshow_CleanVars($_POST, 'item_order',    100,'int'));
            $obj->setVar('item_languagecode', slideshow_CleanVars($_POST, 'item_languagecode', '', 'string'));

            // item_type
            $itemType = slideshow_CleanVars($_POST, 'item_type', 'image', 'string');
            if (!in_array($itemType, $allowedTypes, true)) {
                $itemType = 'image';
            }
            $obj->setVar('item_type', $itemType);

            // Video URL
            $obj->setVar('item_video_url', slideshow_CleanVars($_POST, 'item_video_url', '', 'string'));

            // Resim: yeni dosya yüklendiyse güncelle, yoksa eskisini koru
            $existingImg = $obj->getVar('item_img');
            $newImg      = $item_handler->uploadimg($existingImg);
            $obj->setVar('item_img', $newImg);

            // Tarihler — PHP 8 güvenli
            $obj->setVar('item_startdate', slideshow_parseDateTime(
                isset($_POST['item_startdate']) ? $_POST['item_startdate'] : null,
                strtotime($obj->getVar('item_startdate'))
            ));
            $obj->setVar('item_enddate', slideshow_parseDateTime(
                isset($_POST['item_enddate']) ? $_POST['item_enddate'] : null,
                strtotime($obj->getVar('item_enddate'))
            ));

            if (!$item_handler->insert($obj)) {
                xoops_error(implode('<br>', $obj->getErrors()));
                xoops_cp_footer();
                exit();
            }
        }

        redirect_header('slideshow.php', 1, _AM_SLIDESHOW_MSG_EDITSUCCESS);
        xoops_cp_footer();
        exit();

    // ── Item: Delete ──────────────────────────────────────────────────────
    case 'deleteitem':
        $item_id = slideshow_CleanVars($_REQUEST, 'item_id', 0, 'int');
        $obj     = $item_handler->get($item_id);

        // Fiziksel dosyayı sil (XOOPS_ROOT_PATH kullan — bug fix)
        $item_handler->deleteimg($obj->getVar('item_img'));

        if (!$item_handler->delete($obj)) {
            xoops_error(implode('<br>', $obj->getErrors()));
            xoops_cp_footer();
            exit();
        }

        redirect_header('slideshow.php', 1, _AM_SLIDESHOW_MSG_DELETESUCCESS);
        xoops_cp_footer();
        exit();

    // ── Item: Toggle status (AJAX) ────────────────────────────────────────
    case 'item_status':
        $item_id = slideshow_CleanVars($_REQUEST, 'item_id', 0, 'int');

        if ($item_id > 0) {
            $obj = $item_handler->get($item_id);
            $obj->setVar('item_status', (int)!$obj->getVar('item_status'));

            if ($item_handler->insert($obj)) {
                exit();
            }

            echo $obj->getHtmlErrors();
        }
        exit();
}

// Fallback
redirect_header('slideshow.php', 3, _AM_SLIDESHOW_MSG_NOTINFO);
xoops_cp_footer();
exit();
