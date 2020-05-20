<?php
/**
 * XOOPS slideshow module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         module
 * @since           2.5.0
 * @author          Mohtava Project <http://www.mohtava.com>
 * @author          Hossein Azizabadi <djvoltan@gmail.com>
 * @version         $Id: $
 */

function nivoslider_list_show($options)
{
    global $xoTheme;
    $block                   = [];
    $block['slidewidth']     = $options[0];
    $block['slideheight']    = $options[1];
    $block['imagewidth']     = $options[2];
    $block['imageheight']    = $options[3];
    $info['category']        = $options[4];
    $block['showtype']       = $options[5];
    $info['limit']           = $options[6];
    $block['style']          = $options[7];
    $block['displaycaption'] = $options[8];

    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);

    if ($block['style']) {
        switch ($block['showtype']) {
            case 'nivo':
                //$xoTheme->addScript("browse.php?Frameworks/jquery/jquery.js");
                $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/assets/js/nivo/jquery.nivo.slider.js');
                $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/assets/js/nivo/nivo-setting.js');
                $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/assets/css/nivo/nivo-slider.css');
                $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/assets/css/nivo/default/default.css');
                $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/assets/css/nivo/light/light.css');
                $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/assets/css/nivo/dark/dark.css');
                $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/assets/css/nivo/bar/bar.css');
                break;
        }
    } else {
        switch ($block['showtype']) {
            case 'nivo':
                break;
        }
    }

    $item_handler   = xoops_getModuleHandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);

    return $block;
}

function nivoslider_list_edit($options)
{
    $category_handler = xoops_getModuleHandler('category', 'slideshow');

    $criteria = new CriteriaCompo();
    $criteria->setSort("category_id");
    $criteria->setOrder("ASC");
    $categories = $category_handler->getall($criteria);

    $form = _MB_SLIDESHOW_OP1 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[0]\" value=\"" . $options[0] . "\" /><br />";
    $form .= _MB_SLIDESHOW_OP2 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[1]\" value=\"" . $options[1] . "\" /><br />";
    $form .= _MB_SLIDESHOW_OP3 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[2]\" value=\"" . $options[2] . "\" /><br />";
    $form .= _MB_SLIDESHOW_OP4 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[3]\" value=\"" . $options[3] . "\" /><br />";

    $category = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[4]', $options[4]);
    $i        = 1;
    foreach (array_keys($categories) as $i) {
        $category->addOption($categories[$i]->getVar("category_id"), $categories[$i]->getVar("category_title"));
    }
    $form .= _MB_SLIDESHOW_OP5 . " : " . $category->render() . '<br />';
    $form .= "<input name=\"options[5]\" value=\"nivo\" type=\"hidden\"/>";
    $form .= _MB_SLIDESHOW_OP7 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[6]\" value=\"" . $options[6] . "\" /><br />";

    if ($options[7] == false) {
        $checked_yes = '';
        $checked_no  = 'checked="checked"';
    } else {
        $checked_yes = 'checked="checked"';
        $checked_no  = '';
    }
    $form .= _MB_SLIDESHOW_STYLE . " : <input name=\"options[7]\" value=\"1\" type=\"radio\" " . $checked_yes . "/>" . _YES . "&nbsp;\n";
    $form .= "<input name=\"options[7]\" value=\"0\" type=\"radio\" " . $checked_no . "/>" . _NO . "<br />\n";

    $form .= _MB_SLIDESHOW_OP8 . '&nbsp;';
    if (1 == $options[8]) {
        $chk = " checked='checked'";
    }
    $form .= "<input type='radio' name='options[8]' value='1'" . $chk . ' >&nbsp;' . _YES . '';
    $chk  = '';
    if (0 == $options[8]) {
        $chk = " checked='checked'";
    }
    $form .= "&nbsp;<input type='radio' name='options[8]' value='0'" . $chk . ' >' . _NO . '<br>';

    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);

    return $form;
}
