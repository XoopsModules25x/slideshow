<?php
/**
 * XOOPS slideshow module — Thumbnail Rail Slider block
 * Sol: büyük aktif slide | Sağ: dikey thumbnail listesi
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    GNU GPL 2
 * @version    2.1
 */

function thumbnailrail_list_show($options)
{
    global $xoTheme;

    $block = [];

    $block['mainwidth']      = (int)($options[0] ?? 800);
    $block['mainheight']     = (int)($options[1] ?? 450);
    $block['thumbwidth']     = (int)($options[2] ?? 160);
    $block['thumbheight']    = (int)($options[3] ?? 100);
    $info['category']        = (int)($options[4] ?? 1);
    $info['limit']           = (int)($options[5] ?? 8);
    $block['autoplay']       = (int)($options[6] ?? 1);
    $block['autoplaytime']   = (int)($options[7] ?? 4000);
    $block['displaycaption'] = (int)($options[8] ?? 1);
    $block['style']          = (int)($options[9] ?? 1);

    $block['rail_id'] = 'rail_' . md5(serialize($options));

    if ($block['style']) {
        $xoTheme->addStylesheet('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        $xoTheme->addScript('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    }

    $item_handler   = xoops_getModuleHandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);

    return $block;
}

function thumbnailrail_list_edit($options)
{
    $category_handler = xoops_getModuleHandler('category', 'slideshow');
    $criteria = new CriteriaCompo();
    $criteria->setSort('category_id');
    $criteria->setOrder('ASC');
    $categories = $category_handler->getall($criteria);

    $form  = _MB_SLIDESHOW_OP1 . ': <input type="text" name="options[0]" value="' . ($options[0] ?? 800) . '" size="6" /><br />';
    $form .= _MB_SLIDESHOW_OP2 . ': <input type="text" name="options[1]" value="' . ($options[1] ?? 450) . '" size="6" /><br />';
    $form .= '<b>Thumbnail width</b>: <input type="text" name="options[2]" value="' . ($options[2] ?? 160) . '" size="6" /><br />';
    $form .= '<b>Thumbnail height</b>: <input type="text" name="options[3]" value="' . ($options[3] ?? 100) . '" size="6" /><br />';

    $cat_sel = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[4]', $options[4] ?? 1);
    foreach ($categories as $cat) {
        $cat_sel->addOption($cat->getVar('category_id'), $cat->getVar('category_title'));
    }
    $form .= _MB_SLIDESHOW_OP5 . ': ' . $cat_sel->render() . '<br />';

    $form .= _MB_SLIDESHOW_OP7 . ': <input type="text" name="options[5]" value="' . ($options[5] ?? 8) . '" size="4" /><br />';

    $chkY = ($options[6] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[6] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SWIPER_AUTOPLAY . ' <input type="radio" name="options[6]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[6]" value="0"' . $chkN . '> ' . _NO . '<br />';

    $form .= _MB_SWIPER_AUTOPLAYTIME . ': <input type="text" name="options[7]" value="' . ($options[7] ?? 4000) . '" size="6" /><br />';

    $chkY = ($options[8] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[8] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SLIDESHOW_OP8 . ' <input type="radio" name="options[8]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[8]" value="0"' . $chkN . '> ' . _NO . '<br />';

    $chkY = ($options[9] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[9] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SLIDESHOW_STYLE . ' <input type="radio" name="options[9]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[9]" value="0"' . $chkN . '> ' . _NO . '<br />';

    return $form;
}
