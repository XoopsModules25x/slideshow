<?php
/**
 * XOOPS slideshow module — Ticker / Marquee block
 * Yatay kayan başlık bandı, görsel yok — çok dar alanlara sığar
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    GNU GPL 2
 * @version    2.1
 */

function ticker_list_show($options)
{
    $block = [];

    $block['label']        = !empty($options[0]) ? $options[0] : 'SON HABERLER';
    $block['speed']        = (int)($options[1] ?? 40);    // px/sn — düşük = yavaş
    $block['bgcolor']      = !empty($options[2]) ? $options[2] : '#1a1a2e';
    $block['textcolor']    = !empty($options[3]) ? $options[3] : '#ffffff';
    $block['labelcolor']   = !empty($options[4]) ? $options[4] : '#e74c3c';
    $block['separator']    = !empty($options[5]) ? $options[5] : ' ◆ ';
    $info['category']      = (int)($options[6] ?? 1);
    $info['limit']         = (int)($options[7] ?? 10);
    $block['height']       = (int)($options[8] ?? 38);
    $block['pauseonhover'] = (int)($options[9] ?? 1);

    $block['ticker_id'] = 'ticker_' . md5(serialize($options));

    $item_handler   = xoops_getModuleHandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);

    return $block;
}

function ticker_list_edit($options)
{
    $category_handler = xoops_getModuleHandler('category', 'slideshow');
    $criteria = new CriteriaCompo();
    $criteria->setSort('category_id');
    $criteria->setOrder('ASC');
    $categories = $category_handler->getall($criteria);

    $form  = '<b>Etiket metni (sol bant)</b>: <input type="text" name="options[0]" value="' . htmlspecialchars($options[0] ?? 'SON HABERLER') . '" size="20" /><br />';
    $form .= '<b>Hız (px/sn, düşük=yavaş)</b>: <input type="text" name="options[1]" value="' . ($options[1] ?? 40) . '" size="6" /><br />';
    $form .= '<b>Arka plan rengi</b>: <input type="color" name="options[2]" value="' . ($options[2] ?? '#1a1a2e') . '" /><br />';
    $form .= '<b>Yazı rengi</b>: <input type="color" name="options[3]" value="' . ($options[3] ?? '#ffffff') . '" /><br />';
    $form .= '<b>Etiket rengi</b>: <input type="color" name="options[4]" value="' . ($options[4] ?? '#e74c3c') . '" /><br />';
    $form .= '<b>Ayraç karakter</b>: <input type="text" name="options[5]" value="' . htmlspecialchars($options[5] ?? ' ◆ ') . '" size="10" /><br />';

    $cat_sel = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[6]', $options[6] ?? 1);
    foreach ($categories as $cat) {
        $cat_sel->addOption($cat->getVar('category_id'), $cat->getVar('category_title'));
    }
    $form .= _MB_SLIDESHOW_OP5 . ': ' . $cat_sel->render() . '<br />';

    $form .= _MB_SLIDESHOW_OP7 . ': <input type="text" name="options[7]" value="' . ($options[7] ?? 10) . '" size="4" /><br />';
    $form .= '<b>Bant yüksekliği (px)</b>: <input type="text" name="options[8]" value="' . ($options[8] ?? 38) . '" size="6" /><br />';

    $chkY = ($options[9] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[9] ?? 1) ? '' : " checked='checked'";
    $form .= '<b>Hover\'da durdur?</b> <input type="radio" name="options[9]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[9]" value="0"' . $chkN . '> ' . _NO . '<br />';

    return $form;
}
