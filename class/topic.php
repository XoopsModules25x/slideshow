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
 
class slideshow_topic extends XoopsObject {

	public function slideshow_topic() {
		$this->initVar ( 'topic_id', XOBJ_DTYPE_INT );
		$this->initVar ( 'topic_title', XOBJ_DTYPE_TXTBOX );
		$this->initVar ( 'topic_showtype', XOBJ_DTYPE_TXTBOX );
		$this->initVar ( 'topic_created', XOBJ_DTYPE_INT );
		
		$this->db = $GLOBALS ['xoopsDB'];
		$this->table = $this->db->prefix ( 'slideshow_topic' );
	}
	
	public function getTopicForm() {	
		$form = new XoopsThemeForm ( _AM_SLIDESHOW_TOPIC_FORM, 'topic', 'backend.php', 'post' );
		$form->setExtra ( 'enctype="multipart/form-data"' );
		if ($this->isNew ()) {
			$form->addElement ( new XoopsFormHidden ( 'op', 'addtopic' ) );
		} else {
			$form->addElement ( new XoopsFormHidden ( 'op', 'edittopic' ) );
		}
		$form->addElement ( new XoopsFormHidden ( 'topic_id', $this->getVar ( 'topic_id', 'e' ) ) );
		$form->addElement ( new XoopsFormText ( _AM_SLIDESHOW_TOPIC_TITLE, 'topic_title', 50, 255, $this->getVar ( 'topic_title', 'e' ) ), true );
      
      if ($this->isNew ()) {
	      $select = new XoopsFormSelect(_AM_SLIDESHOW_TOPIC_SHOWTYPE, 'topic_showtype',$this->getVar ( 'topic_showtype', 'e' ));
			$select->addOption("slideshow", _AM_SLIDESHOW_TOPIC_SLIDESHOW);
			$select->addOption("marquee", _AM_SLIDESHOW_TOPIC_MARQUEE);
			$form->addElement($select);
      }
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

class slideshowTopicHandler extends XoopsPersistableObjectHandler {
	
	public function slideshowTopicHandler($db) {
		parent::XoopsPersistableObjectHandler ( $db, 'slideshow_topic', 'slideshow_topic', 'topic_id', 'topic_title' );
	}
	
	public function topicList($info) {
		$ret = array ();
		$criteria = new CriteriaCompo ();
      $criteria->setSort ( $info ['topic_sort'] );
		$criteria->setOrder ( $info ['topic_order'] );
		$criteria->setLimit ( $info ['topic_limit'] );
		$criteria->setStart ( $info ['topic_start'] );
		
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
	
	public function topicCount() {
		$criteria = new CriteriaCompo ();
		return $this->getCount ( $criteria );
	}	
	
}	

?>