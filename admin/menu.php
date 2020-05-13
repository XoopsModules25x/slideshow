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
 
$i = 1;
$adminmenu[$i] = array(
    'title' => _AM_SLIDESHOW_HOME,
    'link' => 'admin/index.php',
	 'icon' => 'assets/images/home.png');
$i++;
$adminmenu[$i] = array(
    'title' => _AM_SLIDESHOW_TOPIC,
    'link' => 'admin/topic.php',
	 'icon' => 'assets/images/topic.png');
$i++;
$adminmenu[$i] = array(
    'title' => _AM_SLIDESHOW_SLIDESHOW,
    'link' => 'admin/slideshow.php',
	 'icon' => 'assets/images/item.png');
$i++;
$adminmenu[$i] = array(
    'title' => _AM_SLIDESHOW_MARQUEE,
    'link' => 'admin/marquee.php',
	 'icon' => 'assets/images/item.png');
?>