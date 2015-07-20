<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcAjax {
	
	public static function focus($id) {
		return '<script type="text/javascript">jQuery("#'.$id.'").focus();</script>';
	}
	
	public static function popoverStrip($id, $title, $content) {
		return 'jQuery("#'.$id.'").popover({
			content: "content", placement: "top", title: "title",
		});';
	}
}