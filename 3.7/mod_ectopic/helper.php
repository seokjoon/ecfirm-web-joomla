<?php /** @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class ModEctopicHelper {

	public static function getItemId($params) {
		static $itemId;
		if(!$itemId) {
			$app = JFactory::getApplication('site');
			$com = JComponentHelper::getComponent('com_ectopic');
			$menu = $app->getMenu();
			$items = $menu->getItems('component_id', $com->id);
			foreach ($items as $item) 
				if($item->query['topiccat'] == $params->get('topiccat')) $itemId = $item->id;
		}
		return $itemId;
	}
	
	public static function getTopics($params = array()) {
		$topiccat = $params->get('topiccat');
		$limit = $params->get('limit');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('t.topic, t.modified, t.created, t.topiccat, t.user, t.state, t.title, 
				t.hits, t.topiccmt, t.topiclike, t.options, t.body, t.imgs, t.files')
			->from('#__ec_topic as t')
			->setLimit($limit)
			->order('t.topic DESC');
		if(!empty($topiccat)) $query->where('t.topiccat = '.$db->quote($topiccat));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}