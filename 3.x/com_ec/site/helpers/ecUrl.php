<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcUrl {
	
	public static function getItemId() {
		$itemId = @JFactory::getApplication()->getMenu()->getActive()->id;
		return (is_numeric($itemId)) ? $itemId : 0;
	}
	
	public static function getObjcat() {
		$objcat = JFactory::getApplication()->getMenu()->getActive()->query['objcat'];
		return (is_numeric($objcat)) ? $objcat : 0;
	}
}