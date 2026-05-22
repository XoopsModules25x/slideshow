<?php
/**
 * XOOPS slideshow module — Sidebar Card Slider block
 * Dar sidebar alanına sığacak dikey kart formatı
 * Sol: küçük kare resim | Sağ: başlık + açıklama
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    GNU GPL 2
 * @version    2.1
 */

function sidebarcard_list_show($options)
{
    global $xoTheme;

    $block = [];

    $block['cardwidth']      = (int)($options[0] ?? 300);
    $block['thumbsize']      = (int)($options[1] ?? 80);
    $info['category']        = (int)($options[2] ?? 1);
    $info['limit']           = (int)($options[3] ?? 6);
    $block['autoplay']       = (int)($options[4] ?? 1);
    $block['autoplaytime']   = (int)($options[5] ?? 3500);
    $block['displaycaption'] = (int)($options[6] ?? 1);
    $block['accentcolor']    = !empty($options[7]) ? $options[7] : '#e74c3c';
    $block['style']          = (int)($options[8] ?? 1);

    $block['sc_id'] = 'sc_' . md5(serialize($options));

    if ($block['style']) {
        $xoTheme->addStylesheet('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        $xoTheme->addScript('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    }

    $item_handler   = xoops_getModuleHandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);

    return $block;
}

function sidebarcard_list_edit($options)
{
    $category_handler = xoops_getModuleHandler('category', 'slideshow');
    $criteria = new CriteriaCompo();
    $criteria->setSort('category_id');
    $criteria->setOrder('ASC');
    $categories = $category_handler->getall($criteria);

    $form  = '<b>Kart genişliği (px)</b>: <input type="text" name="options[0]" value="' . ($options[0] ?? 300) . '" size="6" /><br />';
    $form .= '<b>Thumbnail boyutu (px)</b>: <input type="text" name="options[1]" value="' . ($options[1] ?? 80) . '" size="6" /><br />';

    $cat_sel = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[2]', $options[2] ?? 1);
    foreach ($categories as $cat) {
        $cat_sel->addOption($cat->getVar('category_id'), $cat->getVar('category_title'));
    }
    $form .= _MB_SLIDESHOW_OP5 . ': ' . $cat_sel->render() . '<br />';

    $form .= _MB_SLIDESHOW_OP7 . ': <input type="text" name="options[3]" value="' . ($options[3] ?? 6) . '" size="4" /><br />';

    $chkY = ($options[4] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[4] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SWIPER_AUTOPLAY . ' <input type="radio" name="options[4]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[4]" value="0"' . $chkN . '> ' . _NO . '<br />';

    $form .= _MB_SWIPER_AUTOPLAYTIME . ': <input type="text" name="options[5]" value="' . ($options[5] ?? 3500) . '" size="6" /><br />';

    $chkY = ($options[6] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[6] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SLIDESHOW_OP8 . ' <input type="radio" name="options[6]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[6]" value="0"' . $chkN . '> ' . _NO . '<br />';

    $form .= '<b>Vurgu rengi (hex)</b>: <input type="color" name="options[7]" value="' . ($options[7] ?? '#e74c3c') . '" /><br />';

    $chkY = ($options[8] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[8] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SLIDESHOW_STYLE . ' <input type="radio" name="options[8]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[8]" value="0"' . $chkN . '> ' . _NO . '<br />';

    return $form;
}
