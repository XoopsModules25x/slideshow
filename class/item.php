<?php

/**
 * XOOPS slideshow module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @version         2.1
 */
class slideshow_item extends \XoopsObject
{
    public function __construct()
    {
        parent::__construct();

        $this->initVar('item_id',           XOBJ_DTYPE_INT);
        $this->initVar('item_title',        XOBJ_DTYPE_TXTBOX);
        $this->initVar('item_caption',      XOBJ_DTYPE_TXTAREA, '');
        $this->initVar('item_category',     XOBJ_DTYPE_INT);
        $this->initVar('item_link',         XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('item_linktarget',   XOBJ_DTYPE_INT,    0);
        $this->initVar('item_status',       XOBJ_DTYPE_INT,    1);
        $this->initVar('item_create',       XOBJ_DTYPE_INT,    0);
        $this->initVar('item_uid',          XOBJ_DTYPE_INT,    0);
        $this->initVar('item_order',        XOBJ_DTYPE_INT,    100);
        $this->initVar('item_img',          XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('item_type',         XOBJ_DTYPE_TXTBOX, 'image');
        $this->initVar('item_video_url',    XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('item_languagecode', XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('item_startdate',    XOBJ_DTYPE_TXTBOX);  // TXTBOX: DB'den string olarak gelir
        $this->initVar('item_enddate',      XOBJ_DTYPE_TXTBOX);
        $this->initVar('dohtml',            XOBJ_DTYPE_INT,    1);
        $this->initVar('dobr',              XOBJ_DTYPE_INT,    1);

        $this->db    = $GLOBALS['xoopsDB'];
        $this->table = $this->db->prefix('slideshow_item');
    }

    /**
     * DB'den gelen tarih string'ini güvenli şekilde unix timestamp'e çevirir.
     * PHP 8 uyumlu — strtotime(false) veya strtotime(null) önlenir.
     */
    private function toTimestamp($value, $fallback)
    {
        if (empty($value)) {
            return $fallback;
        }
        // Zaten numeric ise direkt kullan
        if (is_numeric($value)) {
            return (int)$value;
        }
        $ts = strtotime((string)$value);
        return ($ts !== false && $ts > 0) ? $ts : $fallback;
    }

    public function getSlideshowForm()
    {
        $form = new XoopsThemeForm(_AM_SLIDESHOW_ITEM_FORM, 'item', 'backend.php', 'post');
        $form->setExtra('enctype="multipart/form-data"');

        if ($this->isNew()) {
            $form->addElement(new XoopsFormHidden('op', 'additem'));
            $form->addElement(new XoopsFormHidden('item_uid',
                isset($GLOBALS['xoopsUser']) ? (int)$GLOBALS['xoopsUser']->getVar('uid') : 0
            ));
        } else {
            $form->addElement(new XoopsFormHidden('op', 'edititem'));
        }
        $form->addElement(new XoopsFormHidden('item_id', $this->getVar('item_id', 'e')));

        // ── Kategori ──────────────────────────────────────────────────────
        $category_handler = xoops_getModuleHandler('category', 'slideshow');
        $categories       = $category_handler->getObjects(new CriteriaCompo());
        $category_sel     = new XoopsFormSelect(
            _AM_SLIDESHOW_ITEM_CATEGORY,
            'item_category',
            $this->getVar('item_category')
        );
        foreach ($categories as $cat) {
            $category_sel->addOption(
                $cat->getVar('category_id'),
                $cat->getVar('category_title')
            );
        }
        $form->addElement($category_sel);

        // ── Başlık ────────────────────────────────────────────────────────
        $form->addElement(
            new XoopsFormText(
                _AM_SLIDESHOW_ITEM_TITLE,
                'item_title', 50, 255,
                $this->getVar('item_title', 'e')
            ),
            true
        );

        // ── İçerik Tipi (image / youtube / vimeo) ─────────────────────────
        $type_sel = new XoopsFormSelect(
            _AM_SLIDESHOW_ITEM_TYPE,
            'item_type',
            $this->getVar('item_type', 'e') ?: 'image'
        );
        $type_sel->addOption('image',   _AM_SLIDESHOW_TYPE_IMAGE);
        $type_sel->addOption('youtube', _AM_SLIDESHOW_TYPE_YOUTUBE);
        $type_sel->addOption('vimeo',   _AM_SLIDESHOW_TYPE_VIMEO);
        $form->addElement($type_sel);

        // ── Resim yükleme ─────────────────────────────────────────────────
        $item_img = $this->getVar('item_img') ?: 'blank.gif';
        $imgdir   = '/uploads/slideshow/image/';
        $imgTray  = new XoopsFormElementTray(_AM_SLIDESHOW_ITEM_IMG, '<br />');
        $imgTray->addElement(new XoopsFormLabel('',
            '<img id="image_item" style="max-width:500px;max-height:500px;" src="'
            . XOOPS_URL . $imgdir . $item_img . '" alt="" />'
        ));
        // Yeni dosya yüklemek isteğe bağlı (hem yeni hem düzenleme için)
        $fileEl = new XoopsFormFile(
            _AM_SLIDESHOW_ITEM_FORMUPLOAD,
            'item_img',
            xoops_getModuleOption('img_size', 'slideshow')
        );
        $fileEl->setExtra('accept="image/*"');
        $imgTray->addElement($fileEl);
        $form->addElement($imgTray);

        // ── Video URL ─────────────────────────────────────────────────────
        $form->addElement(new XoopsFormText(
            _AM_SLIDESHOW_ITEM_VIDEO_URL,
            'item_video_url', 80, 500,
            $this->getVar('item_video_url', 'e')
        ));

        // ── Açıklama (caption) ────────────────────────────────────────────
        $form->addElement(new XoopsFormTextArea(
            _AM_SLIDESHOW_ITEM_CAPTION,
            'item_caption',
            $this->getVar('item_caption', 'e'),
            5, 80
        ));

        // ── Link ──────────────────────────────────────────────────────────
        $form->addElement(new XoopsFormText(
            _AM_SLIDESHOW_ITEM_LINK,
            'item_link', 50, 255,
            $this->getVar('item_link', 'e')
        ));

        $defaultTarget = $this->isNew() ? 1 : (int)$this->getVar('item_linktarget', 'e');
        $link_select   = new XoopsFormSelect(_AM_SLIDESHOW_TARGET, 'item_linktarget', $defaultTarget);
        $link_select->addOptionArray([
            0 => _AM_SLIDESHOW_TARGET_0,
            1 => _AM_SLIDESHOW_TARGET_1,
        ]);
        $form->addElement($link_select);

        // ── Durum / Sıra ──────────────────────────────────────────────────
        $form->addElement(
            new XoopsFormRadioYN(
                _AM_SLIDESHOW_ITEM_STATUS,
                'item_status',
                $this->isNew() ? 1 : (int)$this->getVar('item_status', 'e')
            ),
            true
        );

        $defaultOrder = $this->isNew() ? 100 : (int)$this->getVar('item_order', 'e');
        $form->addElement(new XoopsFormText(
            _AM_SLIDESHOW_ITEM_ORDER,
            'item_order', 3, 3, $defaultOrder
        ));

        // ── Dil kodu ──────────────────────────────────────────────────────
        $form->addElement(new XoopsFormText(
            _AM_SLIDESHOW_ITEM_LANGUAGECODE,
            'item_languagecode', 2, 2,
            $this->getVar('item_languagecode', 'e')
        ));

        // ── Tarihler — PHP 8 güvenli timestamp hesabı ─────────────────────
        if ($this->isNew()) {
            $startTimestamp = time() - 60;
            $endTimestamp   = strtotime('+1 year');
        } else {
            $startTimestamp = $this->toTimestamp($this->getVar('item_startdate'), time() - 60);
            $endTimestamp   = $this->toTimestamp($this->getVar('item_enddate'),   strtotime('+1 year'));
        }

        $form->addElement(
            new XoopsFormDateTime(_AM_SLIDESHOW_ITEM_STARTDATE, 'item_startdate', '', $startTimestamp),
            true
        );
        $form->addElement(
            new XoopsFormDateTime(_AM_SLIDESHOW_ITEM_ENDDATE, 'item_enddate', '', $endTimestamp),
            true
        );

        // ── Butonlar ──────────────────────────────────────────────────────
        $button_tray = new XoopsFormElementTray('', '');
        $submit_btn  = new XoopsFormButton('', 'post', _SUBMIT, 'submit');
        $button_tray->addElement($submit_btn);
        $cancel_btn = new XoopsFormButton('', 'cancel', _CANCEL, 'cancel');
        $cancel_btn->setExtra('onclick="javascript:history.go(-1);"');
        $button_tray->addElement($cancel_btn);
        $form->addElement($button_tray);

        $form->display();
    }

    public function toArray()
    {
        $ret  = [];
        $vars = $this->getVars();
        foreach (array_keys($vars) as $i) {
            $ret[$i] = $this->getVar($i);
        }
        return $ret;
    }
}

/**
 * Class slideshowItemHandler
 */
class slideshowItemHandler extends \XoopsPersistableObjectHandler
{
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'slideshow_item', 'slideshow_item', 'item_id', 'item_title');
    }

    public function setitemorder()
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort('item_order');
        $criteria->setOrder('DESC');
        $criteria->setLimit(1);
        $last  = $this->getObjects($criteria);
        $order = 1;
        foreach ($last as $item) {
            $order = $item->getVar('item_order') + 1;
        }
        return $order;
    }

    /**
     * Yeni dosya yüklendiyse kaydet, yoksa mevcut dosya adını döndür.
     */
    public function uploadimg($existingImage = '')
    {
        // Dosya seçilmemiş ya da boş gönderilmiş
        if (empty($_FILES['item_img']['name'])) {
            return $existingImage;
        }

        include_once XOOPS_ROOT_PATH . '/class/uploader.php';

        $uploader = new XoopsMediaUploader(
            XOOPS_ROOT_PATH . '/uploads/slideshow/image/',
            xoops_getModuleOption('img_mime', 'slideshow'),
            xoops_getModuleOption('img_size', 'slideshow'),
            xoops_getModuleOption('img_maxwidth', 'slideshow'),
            xoops_getModuleOption('img_maxheight', 'slideshow')
        );

        if ($uploader->fetchMedia('item_img')) {
            $uploader->setPrefix('slideshow_');
            if (!$uploader->upload()) {
                // Hata mesajını göster ama çökmesine izin verme
                return $existingImage;
            }
            return $uploader->getSavedFileName();
        }

        return $existingImage;
    }

    /**
     * Fiziksel resim dosyasını sil.
     * BUG FIX: XOOPS_ROOT_PATH kullanır (XOOPS_URL değil).
     */
    public function deleteimg($filename)
    {
        if (empty($filename) || $filename === 'blank.gif') {
            return;
        }
        $path = XOOPS_ROOT_PATH . '/uploads/slideshow/image/' . basename($filename);
        if (file_exists($path)) {
            @unlink($path);
        }
    }

    /**
     * YouTube veya Vimeo URL'sini embed URL'ye çevirir.
     */
    public static function parseVideoUrl($url, $type)
    {
        $url = trim((string)$url);
        if ($url === '') {
            return '';
        }

        if ($type === 'youtube') {
            $id = '';
            if (preg_match('/youtu\.be\/([^?&\s\/]+)/', $url, $m))          { $id = $m[1]; }
            elseif (preg_match('/[?&]v=([^&\s]+)/', $url, $m))              { $id = $m[1]; }
            elseif (preg_match('/\/embed\/([^?&\s\/]+)/', $url, $m))        { $id = $m[1]; }
            elseif (preg_match('/\/shorts\/([^?&\s\/]+)/', $url, $m))       { $id = $m[1]; }
            elseif (preg_match('/youtube\.com\/live\/([^?&\s\/]+)/', $url, $m)) { $id = $m[1]; }
            if ($id !== '') {
                return 'https://www.youtube.com/embed/' . htmlspecialchars($id, ENT_QUOTES) . '?rel=0';
            }
        }

        if ($type === 'vimeo') {
            if (preg_match('/vimeo\.com(?:\/video)?\/(\d+)/', $url, $m)) {
                return 'https://player.vimeo.com/video/' . $m[1];
            }
        }

        return '';
    }

    public function itemSAdminList($info)
    {
        $ret      = [];
        $criteria = new CriteriaCompo();

        if (!empty($info['category'])) {
            $criteria->add(new Criteria('item_category', (int)$info['category']));
        }

        $criteria->setSort($info['item_sort']);
        $criteria->setOrder($info['item_order']);
        $criteria->setLimit($info['item_limit']);
        $criteria->setStart($info['item_start']);

        $obj = $this->getObjects($criteria, false);

        if ($obj) {
            // Kategori lookup tablosu
            $list = [];
            if (is_array($info['allcategories'])) {
                foreach ($info['allcategories'] as $cat) {
                    $cid        = $cat->getVar('category_id');
                    $list[$cid] = $cat->getVar('category_title');
                }
            }

            foreach ($obj as $root) {
                $tab = $root->toArray();

                $tab['imgurl']        = XOOPS_URL . '/uploads/slideshow/image/' . $root->getVar('item_img');
                $catId                = $root->getVar('item_category');
                $tab['categorytitle'] = isset($list[$catId]) ? $list[$catId] : '-';
                $tab['embed_url']     = self::parseVideoUrl(
                    $root->getVar('item_video_url'),
                    $root->getVar('item_type')
                );

                $ret[] = $tab;
            }
        }

        return $ret;
    }

    public function itemCount($info = null)
    {
        return $this->getCount(new CriteriaCompo());
    }

    /**
     * Blok için aktif öğeleri döndürür — tarih filtresi DB'de uygulanır.
     */
    public function itemBlockList($info)
    {
        $ret      = [];
        $criteria = new CriteriaCompo();

        $criteria->add(new Criteria('item_category', (int)$info['category']));
        $criteria->add(new Criteria('item_status', 1));

        // Tarih aralığı filtresi (BUG FIX — eskiden sadece Smarty'de yapılıyordu)
        $now = date('Y-m-d H:i:s');
        $criteria->add(new Criteria('item_startdate', $now, '<='));
        $criteria->add(new Criteria('item_enddate',   $now, '>='));

        $criteria->setSort('item_order');
        $criteria->setOrder('ASC');

        if (!empty($info['limit'])) {
            $criteria->setLimit((int)$info['limit']);
        }

        $obj = $this->getObjects($criteria, false);

        if ($obj) {
            foreach ($obj as $root) {
                $tab              = $root->toArray();
                $tab['imgurl']    = XOOPS_URL . '/uploads/slideshow/image/' . $root->getVar('item_img');
                $tab['embed_url'] = self::parseVideoUrl(
                    $root->getVar('item_video_url'),
                    $root->getVar('item_type')
                );
                $ret[] = $tab;
            }
        }

        return $ret;
    }
}
