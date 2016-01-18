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

require 'header.php';
xoops_cp_header();

$op = slideshow_CleanVars($_REQUEST, 'op', '', 'string');

$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');

switch ($op)
{
    case 'new_topic':
        $obj = $topic_handler->create();
		  $obj->getTopicForm();
        break;

    case 'edit_topic':
        $topic_id = slideshow_CleanVars($_REQUEST, 'topic_id', 0, 'int');
        if ($topic_id > 0) {
            $obj = $topic_handler->get($topic_id);
			   $obj->getTopicForm();
        } else {
            redirect_header('topic.php', 1, _AM_SLIDESHOW_MSG_EDIT_ERROR);
        }
        break; 
        
     case 'delete_topic':
        $topic_id = slideshow_CleanVars($_REQUEST, 'topic_id', 0, 'int');
        if ($topic_id > 0) {
            // Prompt message
            xoops_confirm(array("topic_id"=>$topic_id), 'backend.php?op=deletetopic', _AM_SLIDESHOW_MSG_DELETE);
				xoops_cp_footer();
        } 
        break; 
       
      default:
        $info = array();
        $info['topic_sort'] = 'topic_id';
        $info['topic_order'] = 'DESC';
	     // get limited information
        if (isset($_REQUEST['limit'])) {
            $info['topic_limit'] = slideshow_CleanVars($_REQUEST, 'limit', 0, 'int');
        } else {
            $info['topic_limit'] = 15;
        }

        // get start information
        if (isset($_REQUEST['start'])) {
            $info['topic_start'] = slideshow_CleanVars($_REQUEST, 'start', 0, 'int');
        } else {
            $info['topic_start'] = 0;
        }
        
        $topics = $topic_handler->topicList($info);
        $topic_numrows = $topic_handler->topicCount();

        if ($topic_numrows > $info['topic_limit']) {
            $topic_pagenav = new XoopsPageNav($topic_numrows,  $info['topic_limit'], $info['topic_start'], 'start', 'limit=' . $info['topic_limit']);
            $topic_pagenav = $topic_pagenav->renderNav(4);
        } else {
            $topic_pagenav = '';
        }
        
        $xoopsTpl->assign('topics', $topics);
        $xoopsTpl->assign('topic_pagenav', $topic_pagenav);
        
        // Call template file
		  $xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/slideshow/templates/admin/slideshow_topic.html');
	     break;     
}        

// footer
xoops_cp_footer();
?>