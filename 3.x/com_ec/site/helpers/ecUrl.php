<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcUrl {
	
	public static function getItemId() {
		$itemId = @JFactory::getApplication()->getMenu()->getActive()->id;
		return (is_numeric($itemId)) ? $itemId : 0;
	}
	
	public static function getItemIdCom($option) {
		$app = JFactory::getApplication('site');
		$itemId = $app->getUserState($option.'.itemId');
		if(!$itemId) { //EcDebug::log(__method__);
			$com = JComponentHelper::getComponent($option);
			$menu = $app->getMenu();
			$items = $menu->getItems('component_id', $com->id);
			$itemId = $items[0]->id;//EcDebug::lp($items, true);
			$app->setUserState($option.'.itemId', $itemId);
		}
		return $itemId;
	}
	
	public static function getObjcat() {
		$objcat = JFactory::getApplication()->getMenu()->getActive()->query['objcat'];
		return (is_numeric($objcat)) ? $objcat : 0;
	}
}