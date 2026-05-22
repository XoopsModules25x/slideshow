<?php
/**
 * XOOPS slideshow module — Grid Mosaic block
 * Statik 2x2 / 3x2 fotoğraf grid, hover overlay + başlık
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    GNU GPL 2
 * @version    2.1
 */

function gridmosaic_list_show($options)
{
    $block = [];

    $block['columns']        = (int)($options[0] ?? 3);   // 2 veya 3
    $block['rows']           = (int)($options[1] ?? 2);
    $block['cellheight']     = (int)($options[2] ?? 180);
    $info['category']        = (int)($options[3] ?? 1);
    $block['displaycaption'] = (int)($options[4] ?? 1);
    $block['hovercolor']     = !empty($options[5]) ? $options[5] : '#e74c3c';
    $block['gap']            = (int)($options[6] ?? 6);

    $info['limit'] = $block['columns'] * $block['rows'];
    $block['mosaic_id'] = 'mosaic_' . md5(serialize($options));

    $item_handler   = xoops_getModuleHandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);

    return $block;
}

function gridmosaic_list_edit($options)
{
    $category_handler = xoops_getModuleHandler('category', 'slideshow');
    $criteria = new CriteriaCompo();
    $criteria->setSort('category_id');
    $criteria->setOrder('ASC');
    $categories = $category_handler->getall($criteria);

    $col_sel = new XoopsFormSelect('<b>Sütun sayısı</b>', 'options[0]', $options[0] ?? 3);
    $col_sel->addOption(2, '2 Sütun');
    $col_sel->addOption(3, '3 Sütun');
    $col_sel->addOption(4, '4 Sütun');
    $form  = '<b>Sütun sayısı</b>: ' . $col_sel->render() . '<br />';

    $row_sel = new XoopsFormSelect('<b>Satır sayısı</b>', 'options[1]', $options[1] ?? 2);
    $row_sel->addOption(1, '1 Satır');
    $row_sel->addOption(2, '2 Satır');
    $row_sel->addOption(3, '3 Satır');
    $form .= '<b>Satır sayısı</b>: ' . $row_sel->render() . '<br />';

    $form .= '<b>Hücre yüksekliği (px)</b>: <input type="text" name="options[2]" value="' . ($options[2] ?? 180) . '" size="6" /><br />';

    $cat_sel = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[3]', $options[3] ?? 1);
    foreach ($categories as $cat) {
        $cat_sel->addOption($cat->getVar('category_id'), $cat->getVar('category_title'));
    }
    $form .= _MB_SLIDESHOW_OP5 . ': ' . $cat_sel->render() . '<br />';

    $chkY = ($options[4] ?? 1) ? " checked='checked'" : '';
    $chkN = ($options[4] ?? 1) ? '' : " checked='checked'";
    $form .= _MB_SLIDESHOW_OP8 . ' <input type="radio" name="options[4]" value="1"' . $chkY . '> ' . _YES;
    $form .= ' <input type="radio" name="options[4]" value="0"' . $chkN . '> ' . _NO . '<br />';

    $form .= '<b>Hover rengi (hex)</b>: <input type="color" name="options[5]" value="' . ($options[5] ?? '#e74c3c') . '" /><br />';
    $form .= '<b>Hücre boşluğu (px)</b>: <input type="text" name="options[6]" value="' . ($options[6] ?? 6) . '" size="4" /><br />';

    return $form;
}
