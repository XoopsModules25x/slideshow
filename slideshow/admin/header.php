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
 
require '../../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/include/cp_header.php';
require_once XOOPS_ROOT_PATH . '/class/tree.php';
include_once XOOPS_ROOT_PATH . '/class/pagenav.php';

include XOOPS_ROOT_PATH . '/modules/slideshow/include/functions.php';
 
if ( file_exists($GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php'))){
   include_once $GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php');
   //return true;
}else{
   redirect_header("../../../admin.php", 5, _AM_MODULEADMIN_MISSING, false); 
   //return false;
}

xoops_load('xoopsformloader');
 
 
$item_handler = xoops_getmodulehandler('item', 'slideshow');
$topic_handler = xoops_getmodulehandler('topic', 'slideshow');
 
?>