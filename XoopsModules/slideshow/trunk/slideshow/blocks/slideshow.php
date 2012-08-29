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
 
function slideshow_list_show($options) {
	 global $xoTheme;
	 $block = array();
	 $block['slidewidth'] = $options[0];
    $block['slideheight'] = $options[1];
    $block['imagewidth'] = $options[2];
    $block['imageheight'] = $options[3];
    $info['topic'] = $options[4];
    $block['showtype'] = $options[5];
    $info['limit'] = $options[6];
    $block['style'] = $options[7];
    
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
	 array_shift($options);
	 array_shift($options);
	 
	 if($block['style']) {
		 switch($block['showtype']) {
			 case 'marquee':
			    $xoTheme->addScript("browse.php?Frameworks/jquery/jquery.js");
			    $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/js/marquee/marquee.js');
			    $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/js/marquee/setting.js');
			    $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/css/marquee/marquee.css');
			    $info ['type'] = 'marquee';
				 break;
				 
			 case 'slideshow':
			     $style = '
		         .slider {
						width: '. $block['slidewidth'] .'px;
						height: '. $block['slideheight']*1.06 .'px;
					}
					.slider .main {
						height: '. $block['slideheight']*1.06 .'px;
					}
					.slider .page {
						width: '. $block['slidewidth'] .'px;
						height: '. $block['slideheight'] .'px;
					}	
					.slider .scrollable {
						width: '. $block['slidewidth'] .'px;
						height: '. $block['slideheight'] .'px;
					}
					.slider .item {
						width: '. $block['slidewidth'] .'px;
						height: '. $block['slideheight'] .'px;
					}
					.slider .item .itemleft img {
						width: '. $block['slidewidth']/2 .'px;
					}
					';
					
				 $xoTheme->addScript("browse.php?Frameworks/jquery/jquery.js");
			    $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/js/slideshow/scrollable.js');
			    $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/js/slideshow/setting.js');
				 $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/css/slideshow/scrollable.css');
				 $xoTheme->addStylesheet( null, array ('rel' => 'stylesheet'), $style );
				 $info ['type'] = 'slideshow';
				 break;
				 
			 case 'slideshow1':
				 $xoTheme->addScript("browse.php?Frameworks/jquery/jquery.js");
			    $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/js/slideshow/sliderkit.min.js');
			    $xoTheme->addScript(XOOPS_URL . '/modules/slideshow/js/slideshow/sliderkitsetting.js');
				 $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/css/slideshow/sliderkit-core.css');	
				 $xoTheme->addStylesheet(XOOPS_URL . '/modules/slideshow/css/slideshow/sliderkit-demos.css');
				 $info ['type'] = 'slideshow';	
				 break; 
		 }
	 } else {
		 switch($block['showtype']) {
			 case 'marquee':
			    $info ['type'] = 'marquee';
				 break;
				 
			 case 'slideshow':
				 $info ['type'] = 'slideshow';
				 break;
				 
			 case 'slideshow1':
				 $info ['type'] = 'slideshow';	
				 break; 
		 }
	 }	
	 
	 $item_handler = xoops_getmodulehandler('item', 'slideshow');
    $block['items'] = $item_handler->itemBlockList($info);
	 
	 return $block;
}

function slideshow_list_edit($options) {
	
	 $topic_handler = xoops_getmodulehandler('topic', 'slideshow');

    $criteria = new CriteriaCompo();
    $criteria->setSort("topic_id");
    $criteria->setOrder("ASC");
    $topics = $topic_handler->getall($criteria);

	 $form  =   _MB_SLIDESHOW_OP1 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[0]\" value=\"" . $options[0] . "\" /><br />";
    $form .=   _MB_SLIDESHOW_OP2 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[1]\" value=\"" . $options[1] . "\" /><br />";
    $form .=   _MB_SLIDESHOW_OP3 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[2]\" value=\"" . $options[2] . "\" /><br />";
    $form .=   _MB_SLIDESHOW_OP4 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[3]\" value=\"" . $options[3] . "\" /><br />";
    
    $topic = new XoopsFormSelect(_MB_SLIDESHOW_OP5, 'options[4]', $options[4]);
    $i = 1;
    foreach (array_keys($topics) as $i) {
        $topic->addOption($topics[$i]->getVar("topic_id"), $topics[$i]->getVar("topic_title") .' - '. $topics[$i]->getVar("topic_showtype"));
    }
    $form .= _MB_SLIDESHOW_OP5 . " : " . $topic->render() . '<br />';
    
    $type = new XoopsFormSelect(_MB_SLIDESHOW_OP6, 'options[5]', $options[5]);
    $type->addOption('slideshow',_MB_SLIDESHOW_SLIDESHOW);
    $type->addOption('slideshow1',_MB_SLIDESHOW_SLIDESHOW1);
    $type->addOption('marquee',_MB_SLIDESHOW_MARQUEE);
    $form .= _MB_SLIDESHOW_OP6 . " : " . $type->render() . '<br />';
    $form .=   _MB_SLIDESHOW_OP7 . ":&nbsp;&nbsp;<input type=\"text\" name=\"options[6]\" value=\"" . $options[6] . "\" /><br />";
    
    if ($options[7] == false){		  $checked_yes = '';		  $checked_no = 'checked="checked"';	 }else{		  $checked_yes = 'checked="checked"';		  $checked_no = '';	 }	 $form .= _MB_SLIDESHOW_STYLE . " : <input name=\"options[7]\" value=\"1\" type=\"radio\" " . $checked_yes . "/>" . _YES . "&nbsp;\n";	 $form .= "<input name=\"options[7]\" value=\"0\" type=\"radio\" " . $checked_no . "/>" . _NO . "<br />\n";
	
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
 
?>