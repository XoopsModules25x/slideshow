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
 
//index
define('_AM_SLIDESHOW_INDEX_INFO',"Index");
define('_AM_SLIDESHOW_INDEX_CATEGORIES',"There are %s categories in our database");
define('_AM_SLIDESHOW_INDEX_ITEMS',"There are %s items in our database");

// Add icons
define("_AM_SLIDESHOW_ADD_SLIDESHOW","Add Slideshow Image");
define("_AM_SLIDESHOW_ADD_CATEGORY","Add Slideshow Category");

// Category page
define("_AM_SLIDESHOW_CATEGORY_ID","Id");
define("_AM_SLIDESHOW_CATEGORY_TITLE","Title");
define("_AM_SLIDESHOW_CATEGORY_ACTION","Action");
define("_AM_SLIDESHOW_CATEGORY_FORM","Add new Slideshow Category");
define("_AM_SLIDESHOW_CATEGORY_SLIDESHOW","Slideshow");
define('_AM_SLIDESHOW_CATEGORY_EMPTY', 'Error: There are no category created yet. Before you can create a new slideshow, you must create a category first.');
define('_AM_SLIDESHOW_CATEGORY_DELETECONFIRM', "Are you sure you want to delete <span class='bold red'>%s</span></b> category and <b>ALL</b> of its Slideshow Images? This action is not reversible !!");


// Item page
define("_AM_SLIDESHOW_ITEM_ID","Id");
define("_AM_SLIDESHOW_ITEM_ORDER","Order");	
define("_AM_SLIDESHOW_ITEM_TITLE","Title");
define("_AM_SLIDESHOW_ITEM_IMG","Slideshow Image");
define("_AM_SLIDESHOW_ITEM_CATEGORY","Slideshow Category");
define("_AM_SLIDESHOW_ITEM_ACTION","Action");
define("_AM_SLIDESHOW_ITEM_FORM","Add new item");
define("_AM_SLIDESHOW_ITEM_CAPTION","Caption");
define("_AM_SLIDESHOW_ITEM_LINK","Link");
define("_AM_SLIDESHOW_ITEM_STATUS","Active");
define("_AM_SLIDESHOW_ITEM_FORMUPLOAD","Select your image");
define("_AM_SLIDESHOW_ITEM_LANGUAGECODE","Language Code");
define("_AM_SLIDESHOW_ITEM_STARTDATE","Start Date");
define("_AM_SLIDESHOW_ITEM_ENDDATE","End Date");
define('_AM_SLIDESHOW_TARGET', 'Open Link in');
define('_AM_SLIDESHOW_TARGET_0', 'Same Window');
define('_AM_SLIDESHOW_TARGET_1', 'New Window');

// Msg
define("_AM_SLIDESHOW_MSG_EDIT_ERROR","Error in edit");
define("_AM_SLIDESHOW_MSG_DELETE","Are you sure you want delete this item/category");
define("_AM_SLIDESHOW_MSG_NOTINFO","Not select");
define("_AM_SLIDESHOW_MSG_ERROR","Error");
define("_AM_SLIDESHOW_MSG_WAIT","Please wait");
define("_AM_SLIDESHOW_MSG_INSERTSUCCESS","Added Successfully");
define("_AM_SLIDESHOW_MSG_EDITSUCCESS","Updated Successfully");
define("_AM_SLIDESHOW_MSG_DELETESUCCESS","Deleted Successfully");
?>