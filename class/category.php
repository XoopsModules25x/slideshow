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
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         module
 * @since           2.5.0
 * @author          Mohtava Project <http://www.mohtava.com>
 * @author          Hossein Azizabadi <djvoltan@gmail.com>
 * @version         $Id: $
 */
 
class slideshow_category extends \XoopsObject {

	public function __construct() {
		parent::__construct();
		$this->initVar ( 'category_id', XOBJ_DTYPE_INT );
		$this->initVar ( 'category_title', XOBJ_DTYPE_TXTBOX );
		$this->initVar ( 'category_created', XOBJ_DTYPE_INT );
		
		$this->db = $GLOBALS ['xoopsDB'];
		$this->table = $this->db->prefix ( 'slideshow_category' );
	}
	
	public function getCategoryForm() {	
		$form = new XoopsThemeForm ( _AM_SLIDESHOW_CATEGORY_FORM, 'category', 'backend.php', 'post' );
		$form->setExtra ( 'enctype="multipart/form-data"' );
		if ($this->isNew ()) {
			$form->addElement ( new XoopsFormHidden ( 'op', 'addcategory' ) );
		} else {
			$form->addElement ( new XoopsFormHidden ( 'op', 'editcategory' ) );
		}
		$form->addElement ( new XoopsFormHidden ( 'category_id', $this->getVar ( 'category_id', 'e' ) ) );
		$form->addElement ( new XoopsFormText ( _AM_SLIDESHOW_CATEGORY_TITLE, 'category_title', 50, 255, $this->getVar ( 'category_title', 'e' ) ), true );
      
		// Submit buttons
		$button_tray = new XoopsFormElementTray ( '', '' );
		$submit_btn = new XoopsFormButton ( '', 'post', _SUBMIT, 'submit' );
		$button_tray->addElement ( $submit_btn );
		$cancel_btn = new XoopsFormButton ( '', 'cancel', _CANCEL, 'cancel' );
		$cancel_btn->setExtra ( 'onclick="javascript:history.go(-1);"' );
		$button_tray->addElement ( $cancel_btn );
		$form->addElement ( $button_tray );
		$form->display ();
	}
	
	public function toArray() {
		$ret = array ();
		$vars = $this->getVars ();
		foreach ( array_keys ( $vars ) as $i ) {
			$ret [$i] = $this->getVar ( $i );
		}
		return $ret;
	}
}

class slideshowCategoryHandler extends \XoopsPersistableObjectHandler {
	
	public function __construct(\XoopsDatabase $db) {
		parent::__construct( $db, 'slideshow_category', 'slideshow_category', 'category_id', 'category_title' );
	}
	
	public function categoryList($info) {
		$ret = array ();
		$criteria = new CriteriaCompo ();
      $criteria->setSort ( $info ['category_sort'] );
		$criteria->setOrder ( $info ['category_order'] );
		$criteria->setLimit ( $info ['category_limit'] );
		$criteria->setStart ( $info ['category_start'] );
		
		$obj = $this->getObjects ( $criteria, false );
		if ($obj) {
			foreach ( $obj as $root ) {
				$tab = array ();
				$tab = $root->toArray ();
				$ret [] = $tab;
			}	
		}
		
		return $ret;	
	}	
	
	public function categoryCount() {
		$criteria = new CriteriaCompo ();
		return $this->getCount ( $criteria );
	}	
	
}	

?>