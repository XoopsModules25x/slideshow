<?php

/**
 * XOOPS slideshow module — Swiper Slider block
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @version         2.1
 */

/**
 * @param $options
 * @return array
 */
function swiperslider_list_show($options)
{
    global $xoTheme;

    $block = [];

    $block['slidewidth']      = $options[0];
    $block['slideheight']     = $options[1];
    $block['imagewidth']      = $options[2];
    $block['imageheight']     = $options[3];
    $info['category']         = (int)$options[4];
    $info['limit']            = (int)$options[5];
    $block['style']           = (int)$options[6];
    $block['displaycaption']  = (int)$options[7];
    $block['sliderstyle']     = $options[8];   // effect: slide|fade|cube|coverflow|flip|cards
    $block['autoplay']        = (int)$options[9];
    $block['autoplaytime']    = (int)($options[10] ?? 4000);
    $block['loop']            = (int)($options[11] ?? 1);
    $block['navigation']      = (int)($options[12] ?? 1);
    $block['pagination']      = (int)($options[13] ?? 1);

    // Unique ID per block instance (prevents conflicts with multiple blocks on one page)
    $block['swiper_id'] = 'swiper_' . md5(serialize($options));

    if ($block['style']) {
        // Swiper CSS + JS via CDN (no local copy needed)
        $xoTheme->addStylesheet('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        $xoTheme->addScript('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    }

    $item_handler   = xoops_getModuleHandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);

    return $block;
}

/**
 * @param $options
 * @return string
 */
function swiperslider_list_edit($options)
{
    $category_handler = xoops_getModuleHandler('category', 'slideshow');
    $criteria         = new CriteriaCompo();
    $criteria->setSort('category_id');
    $criteria->setOrder('ASC');
    $categories = $category_handler->getall($criteria);

    $form  = _MB_SLIDESHOW_OP1 . ':&nbsp;&nbsp;<input type="text" name="options[0]" value="' . $options[0] . '" /><br />';
    $form .= _MB_SLIDESHOW_OP2 . ':&nbsp;&nbsp;<input type="text" name="options[1]" value="' . $options[1] . '" /><br />';
    $form .= _MB_SLIDESHOW_OP3 . ':&nbsp;&nbsp;<input type="text" name="options[2]" value="' . $options[2] . '" /><br />';
    $form .= _MB_SLIDESHOW_OP4 . ':&nbsp;&nbsp;<input type="text" name="options[3]" value="' . $options[3] . '" /><br />';

    $category = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[4]', $options[4]);
    foreach ($categories as $cat) {
        $category->addOption($cat->getVar('category_id'), $cat->getVar('category_title'));
    }
    $form .= _MB_SLIDESHOW_OP5 . ' : ' . $category->render() . '<br />';

    $form .= _MB_SLIDESHOW_OP7 . ':&nbsp;&nbsp;<input type="text" name="options[5]" value="' . $options[5] . '" /><br />';

    // Use module style?
    $checked_yes = $options[6] ? 'checked="checked"' : '';
    $checked_no  = $options[6] ? '' : 'checked="checked"';
    $form .= _MB_SLIDESHOW_STYLE . ' : <input name="options[6]" value="1" type="radio" ' . $checked_yes . '/>' . _YES . '&nbsp;';
    $form .= '<input name="options[6]" value="0" type="radio" ' . $checked_no . '/>' . _NO . '<br />';

    // Display caption?
    $chkY = (1 == $options[7]) ? " checked='checked'" : '';
    $chkN = (0 == $options[7]) ? " checked='checked'" : '';
    $form .= _MB_SLIDESHOW_OP8 . '&nbsp;';
    $form .= "<input type='radio' name='options[7]' value='1'" . $chkY . ' >&nbsp;' . _YES;
    $form .= "&nbsp;<input type='radio' name='options[7]' value='0'" . $chkN . ' >' . _NO . '<br>';

    // Swiper effect
    $effect = new XoopsFormSelect(_MB_SWIPER_EFFECT, 'options[8]', $options[8] ?? 'slide');
    $effect->addOption('slide',      'Slide');
    $effect->addOption('fade',       'Fade');
    $effect->addOption('cube',       'Cube');
    $effect->addOption('coverflow',  'Coverflow');
    $effect->addOption('flip',       'Flip');
    $effect->addOption('cards',      'Cards');
    $form .= _MB_SWIPER_EFFECT . ' : ' . $effect->render() . '<br />';

    // Autoplay?
    $chkY = (1 == ($options[9] ?? 1)) ? " checked='checked'" : '';
    $chkN = (0 == ($options[9] ?? 1)) ? " checked='checked'" : '';
    $form .= _MB_SWIPER_AUTOPLAY . '&nbsp;';
    $form .= "<input type='radio' name='options[9]' value='1'" . $chkY . ' >&nbsp;' . _YES;
    $form .= "&nbsp;<input type='radio' name='options[9]' value='0'" . $chkN . ' >' . _NO . '<br>';

    // Autoplay speed (ms)
    $form .= _MB_SWIPER_AUTOPLAYTIME . ':&nbsp;&nbsp;<input type="text" name="options[10]" value="' . ($options[10] ?? 4000) . '" /><br />';

    // Loop?
    $chkY = (1 == ($options[11] ?? 1)) ? " checked='checked'" : '';
    $chkN = (0 == ($options[11] ?? 1)) ? " checked='checked'" : '';
    $form .= _MB_SWIPER_LOOP . '&nbsp;';
    $form .= "<input type='radio' name='options[11]' value='1'" . $chkY . ' >&nbsp;' . _YES;
    $form .= "&nbsp;<input type='radio' name='options[11]' value='0'" . $chkN . ' >' . _NO . '<br>';

    // Navigation arrows?
    $chkY = (1 == ($options[12] ?? 1)) ? " checked='checked'" : '';
    $chkN = (0 == ($options[12] ?? 1)) ? " checked='checked'" : '';
    $form .= _MB_SWIPER_NAVIGATION . '&nbsp;';
    $form .= "<input type='radio' name='options[12]' value='1'" . $chkY . ' >&nbsp;' . _YES;
    $form .= "&nbsp;<input type='radio' name='options[12]' value='0'" . $chkN . ' >' . _NO . '<br>';

    // Pagination dots?
    $chkY = (1 == ($options[13] ?? 1)) ? " checked='checked'" : '';
    $chkN = (0 == ($options[13] ?? 1)) ? " checked='checked'" : '';
    $form .= _MB_SWIPER_PAGINATION . '&nbsp;';
    $form .= "<input type='radio' name='options[13]' value='1'" . $chkY . ' >&nbsp;' . _YES;
    $form .= "&nbsp;<input type='radio' name='options[13]' value='0'" . $chkN . ' >' . _NO . '<br>';

    return $form;
}
