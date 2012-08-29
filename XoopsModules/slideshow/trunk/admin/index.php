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
// Add module stylesheet
$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
// module admin
$index_admin = new ModuleAdmin();
$folder = array(
	XOOPS_ROOT_PATH . '/uploads/slideshow/', 
);
$index_admin = new ModuleAdmin();
$index_admin->addInfoBox(_AM_SLIDESHOW_INDEX_INFO);
$index_admin->addInfoBoxLine(_AM_SLIDESHOW_INDEX_INFO, _AM_SLIDESHOW_INDEX_TOPICS, $topic_handler->topicCount());
$index_admin->addInfoBoxLine(_AM_SLIDESHOW_INDEX_INFO, _AM_SLIDESHOW_INDEX_ITEMS, $item_handler->itemCount());
foreach (array_keys( $folder) as $i) {
    $index_admin->addConfigBoxLine($folder[$i], 'folder');
    $index_admin->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}
$xoopsTpl->assign('renderindex', $index_admin->renderIndex());
// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/slideshow/templates/admin/slideshow_index.html');
// footer
xoops_cp_footer();
?>