<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcUrl {

	public static function getEccat() {
		$objcat = JFactory::getApplication()->getMenu()->getActive()->query['eccat'];
		return (is_numeric($eccat)) ? $eccat : 0;
	}

	public static function getItemId() {
		$itemId = JFactory::getApplication()->getMenu()->getActive()->id;
		return (is_numeric($itemId)) ? $itemId : 0;
	}
}