<?php
/**
 * XOOPS slideshow module — Ken Burns Fullscreen Hero block
 * Tam ekran arka plan, zoom+pan efekti, başlık + CTA butonu overlay
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    GNU GPL 2
 * @version    2.1
 */

function kenburns_list_show($options)
{
    global $xoTheme;

    $block = [];

    $block['height']         = (int)($options[0] ?? 500);
    $info['category']        = (int)($options[1] ?? 1);
    $info['limit']           = (int)($options[2] ?? 6);
    $block['autoplaytime']   = (int)($options[3] ?? 5000);
    $block['overlay']        = $options[4] ?? 'dark';   // dark | light | none
    $block['showbutton']     = (int)($options[5] ?? 1);
    $block['buttontext']     = !empty($options[6]) ? $options[6] : 'Devamını Oku';
    $block['style']          = (int)($options[7] ?? 1);

    $block['kb_id'] = 'kb_' . md5(serialize($options));

    $item_handler   = xoops_getModuleHandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);

    return $block;
}

function kenburns_list_edit($options)
{
    $category_handler = xoops_getModuleHandler('category', 'slideshow');
    $criteria = new CriteriaCompo();
    $criteria->setSort('category_id');
    $criteria->setOrder('ASC');
    $categories = $category_handler->getall($criteria);

    $form  = '<b>Hero height (px)</b>: <input type="text" name="options[0]" value="' . ($options[0] ?? 500) . '" size="6" /><br />';

    $cat_sel = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[1]', $options[1] ?? 1);
    foreach ($categories as $cat) {
        $cat_sel->addOption($cat->getVar('category_id'), $cat->getVar('category_title'));
    }
    $form .= _MB_SLIDESHOW_OP5 . ': ' . $cat_sel->render() . '<br />';

    $form .= _MB_SLIDESHOW_OP7 . ': <input type="text" name="options[2]" value="' . ($options[2] ?? 6) . '" size="4" /><br />';
    $form .= _MB_SWIPER_AUTOPLAYTIME . ': <input type="text" name="options[3]" value="' . ($options[3] ?? 5000) . '" size="6" /><br />';

    $overlay_sel = new XoopsFormSelect('<b>Overlay tipi</b>', 'options[4]', $options[4] ?? 'dark');
    $overlay_sel->addOption('dark',  'Koyu (Dark)');
    $overlay_sel->addOption('light', 'Açık (Light)');
    $overlay_sel->addOption('none',  'Yok (None)');
    $form .= '<b>Overlay tipi</b>: ' . $overlay_sel->render() . '<br />';

    $chkY = ($options[5] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[5] ?? 1) ? '' : " checked='checked'";
    $form .= '<b>CTA Butonu göster?</b> <input type="radio" name="options[5]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[5]" value="0"' . $chkN . '> ' . _NO . '<br />';

    $form .= '<b>Buton metni</b>: <input type="text" name="options[6]" value="' . htmlspecialchars($options[6] ?? 'Devamını Oku') . '" size="20" /><br />';

    $chkY = ($options[7] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[7] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SLIDESHOW_STYLE . ' <input type="radio" name="options[7]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[7]" value="0"' . $chkN . '> ' . _NO . '<br />';

    return $form;
}
