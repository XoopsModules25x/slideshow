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
 
$modversion = array(
    // Main setting
    'name' => _MI_SLIDESHOW_TITLE,
    'description' => _MI_SLIDESHOW_DESC,
    'version' => 1.1,
    'author' => 'Hossein Azizabadi',
    'credits' => 'MOHTAVA',
    'license' => 'GNU GPL 2.0',
    'license_url' => 'www.gnu.org/licenses/gpl-2.0.html/',
    'image' => 'assets/images/logo.png',
    'dirname' => 'slideshow',
    'release_date' => '2011/11/2',
    'module_website_url' => "http://www.mohtava.com/",
    'module_website_name' => "MOHTAVA",
    'help' => 'help',
    'module_status' => "Final",
    // Admin things
    'system_menu' => 1,
    'hasAdmin' => 1,
    'adminindex' => 'admin/index.php',
    'adminmenu' => 'admin/menu.php',
    // Modules scripts
    'onInstall' => 'include/install.php',
    // Main menu
    'hasMain' => 0,
    // Recherche
    'hasSearch' => 0,
    // Commentaires 
    'hasComments' => 0,
    // for module admin class
    'min_php' => '5.2',
    'min_xoops' => '2.5',
    'dirmoduleadmin' => 'Frameworks/moduleclasses',
	 'icons16' => 'Frameworks/moduleclasses/icons/16',
	 'icons32' => 'Frameworks/moduleclasses/icons/32'
);

// sql
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1] = "slideshow_item";
$modversion['tables'][2] = "slideshow_category";

// block
$modversion['blocks'][] = array(
    'file' => 'slideshow_block.php',
    'name' => _MI_SLIDESHOW_BLOCK,
    'description' => '',
    'show_func' => 'slideshow_list_show',
    'edit_func' => 'slideshow_list_edit',
    'options' => '1200|400|1200|400|1|sliderkit|10|1',
    'template' => 'slideshow_item.tpl');
           
// conf
$modversion['config'][] = array(
    'name' => 'img_mime',
    'title' => '_MI_SLIDESHOW_IMAGE_MIME',
    'description' => '_MI_SLIDESHOW_IMAGE_MIME_DESC',
    'formtype' => 'select_multi',
    'valuetype' => 'array',
    'default' => array("image/gif", "image/jpeg", "image/png"),
    'options' => array(
        "bmp" => "image/bmp",
        "gif" => "image/gif",
        "jpeg" => "image/pjpeg",
        "jpeg" => "image/jpeg",
        "jpg" => "image/jpeg",
        "jpe" => "image/jpeg",
        "png" => "image/png"));
        
$modversion['config'][] = array(
    'name' => 'img_size',
    'title' => '_MI_SLIDESHOW_IMAGE_SIZE',
    'description' => '_MI_SLIDESHOW_IMAGE_SIZE_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => '5242880');
    
$modversion['config'][] = array(
    'name' => 'img_maxwidth',
    'title' => '_MI_SLIDESHOW_IMAGE_MAXWIDTH',
    'description' => '_MI_SLIDESHOW_IMAGE_MAXWIDTH_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => '1200');

$modversion['config'][] = array(
    'name' => 'img_maxheight',
    'title' => '_MI_SLIDESHOW_IMAGE_MAXHEIGHT',
    'description' => '_MI_SLIDESHOW_IMAGE_MAXHEIGHT_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'text',
    'default' => '1200');                
?>