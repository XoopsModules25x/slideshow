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

$op = slideshow_CleanVars ( $_REQUEST, 'op', 'new', 'string' );
// Admin header
xoops_cp_header ();
// Redirect to content page
if (! isset ( $_REQUEST )) {
	
	redirect_header("index.php", 3, _AM_SLIDESHOW_MSG_NOTINFO);
	// Include footer
	xoops_cp_footer ();
	exit ();
}
 
switch ($op) {
	case 'addtopic' :
	   $obj = $topic_handler->create ();
		$obj->setVars ( $_REQUEST );
		$obj->setVar ( 'topic_created', time () );
		
		if (! $topic_handler->insert ( $obj )) {
			redirect_header ( 'onclick="javascript:history.go(-1);"', 1, _AM_SLIDESHOW_MSG_ERROR );
			xoops_cp_footer ();
			exit ();
		}
		
		// Redirect page
		redirect_header ( 'topic.php', 1, _AM_SLIDESHOW_MSG_WAIT );
		xoops_cp_footer ();
		exit ();
		break;
		
	case 'edittopic' :
		$topic_id = slideshow_CleanVars ( $_REQUEST, 'topic_id', 0, 'int' );
		if ($topic_id > 0) {
			$obj = $topic_handler->get ( $topic_id );
			$obj->setVars ( $_POST );
			
			if (! $topic_handler->insert ( $obj )) {
				redirect_header ( 'onclick="javascript:history.go(-1);"', 1, _AM_SLIDESHOW_MSG_ERROR );
				xoops_cp_footer ();
				exit ();
			}
		}	
		
		// Redirect page
		redirect_header ( 'topic.php', 1, _AM_SLIDESHOW_MSG_WAIT );
		xoops_cp_footer ();
		exit ();
		break;
	
	case 'deletetopic' :
	   $topic_id = slideshow_CleanVars ( $_REQUEST, 'topic_id', 0, 'int' );
	   $obj = $topic_handler->get ( $topic_id );
		if (! $topic_handler->delete ( $obj )) {
			echo $obj->getHtmlErrors ();
		}
		
		// Redirect page
		redirect_header ( 'topic.php', 1, _AM_SLIDESHOW_MSG_WAIT );
		xoops_cp_footer ();
		exit ();
		break;
		
	case 'additem' :
		$obj = $item_handler->create ();
		$obj->setVars ( $_POST );
		$obj->setVar ( 'item_create', time () );
		$obj->setVar ( 'item_order', $item_handler->setitemorder() );
		$obj->setVar ( 'item_img', $item_handler->uploadimg ( $_POST ['item_img'] ) );
		$obj->setVar ( 'item_thumb', $item_handler->uploadthumb ( $_POST ['item_thumb'] ) );
		if($_POST['item_default'] == 1) {
			$item_handler->updateAll ( 'item_default', 0, $obj );
		}
		
		if (! $item_handler->insert ( $obj )) {
			redirect_header ( 'onclick="javascript:history.go(-1);"', 1, _AM_SLIDESHOW_MSG_ERROR );
			xoops_cp_footer ();
			exit ();
		}
		
		// Redirect page
		redirect_header ( 'index.php', 1, _AM_SLIDESHOW_MSG_WAIT );
		xoops_cp_footer ();
		exit ();
		break;
		
	case 'edititem' :
	   $item_id = slideshow_CleanVars ( $_REQUEST, 'item_id', 0, 'int' );
		if ($item_id > 0) {
		   $obj = $item_handler->get ($item_id);
			$obj->setVars ( $_REQUEST );
			$obj->setVar ( 'item_order', $item_handler->setitemorder() );
			if($_REQUEST['item_default'] == 1) {
				$item_handler->updateAll ( 'item_default', 0, $obj );
			}
			if (! $item_handler->insert ( $obj )) {
				redirect_header ( 'onclick="javascript:history.go(-1);"', 1, _AM_SLIDESHOW_MSG_ERROR );
				xoops_cp_footer ();
				exit ();
			}
		}
		// Redirect page
		redirect_header ( 'index.php', 1, _AM_SLIDESHOW_MSG_WAIT );
		xoops_cp_footer ();
		exit ();
		break;	
		
	case 'deleteitem' :
	   $item_id = slideshow_CleanVars ( $_REQUEST, 'item_id', 0, 'int' );
	   $obj = $item_handler->get ( $item_id );
	   unlink(XOOPS_URL . '/uploads/slideshow/image/' .$obj->getVar ( 'item_img'));
	   unlink(XOOPS_URL . '/uploads/slideshow/thumb/' .$obj->getVar ( 'item_thumb'));
		if (! $item_handler->delete ( $obj )) {
			echo $obj->getHtmlErrors ();
		}
		// Redirect page
		redirect_header ( 'index.php', 1, _AM_SLIDESHOW_MSG_WAIT );
		xoops_cp_footer ();
		exit ();
		break;	
		
	 case 'item_status' :
		$item_id = slideshow_CleanVars ( $_REQUEST, 'item_id', 0, 'int' );
		if ($item_id > 0) {
			$obj = & $item_handler->get ( $item_id );
			$old = $obj->getVar ( 'item_status' );
			$obj->setVar ( 'item_status', ! $old );
			if ($item_handler->insert ( $obj )) {
				exit ();
			}
			echo $obj->getHtmlErrors ();
		}
		break;
		
	case 'item_default' :
		$item_id = slideshow_CleanVars ( $_REQUEST, 'item_id', 0, 'int' );
		$topic_id = slideshow_CleanVars ( $_REQUEST, 'topic_id', 0, 'int' );
		if ($item_id > 0) {
			$criteria = new CriteriaCompo ();
			$criteria->add ( new Criteria ( 'item_topic', $topic_id ) );
			$item_handler->updateAll ( 'item_default', 0, $criteria );
			$obj = & $item_handler->get ( $item_id );
			$obj->setVar ( 'item_default', 1 );
			if ($item_handler->insert ( $obj )) {
				exit ();
			}
			echo $obj->getHtmlErrors ();
		}
		break;				
}

// Redirect page
redirect_header("index.php", 3, _AM_SLIDESHOW_MSG_NOTINFO);
// Include footer
xoops_cp_footer ();
exit ();
?>