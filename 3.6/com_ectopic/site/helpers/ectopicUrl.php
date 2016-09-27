<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicUrl {
	
	public static function getItemId() {
		$itemId = JFactory::getApplication()->getMenu()->getActive()->id;
		return (is_numeric($itemId)) ? $itemId : 0;
	}
	
	public static function getTopiccat() {
		$topiccat = JFactory::getApplication()->getMenu()->getActive()->query['topiccat'];
		return (is_numeric($topiccat)) ? $topiccat : 0;
	}
}