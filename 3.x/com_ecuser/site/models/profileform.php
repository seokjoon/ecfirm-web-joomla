<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserModelProfileform extends EcModelForm	{
	
	public function getItem($valueKey = null)	{
		$valueKey = JFactory::getApplication()->input->get('user', 0, 'uint');
		$this->setState($this->nameKey, $valueKey);
		$item = parent::getItem($valueKey); //EcDebug::lp($item);
		if(empty($item)) return $item;
		
		if((JFactory::getUser()->id) != ($item->user)) return false;
		if($item->user > 0) {
			$table = $this->getTable('User', 'JTable');
			$table->load($item->user);
			$item->name = $table->name;
		} //EcDebug::lp($item);
		
		$urls = json_decode($item->urls, true); //EcDebug::lp($urls);
		$item->urlDefault = ((isset($urls['default'])) && (!empty($urls['default']))) ? $urls['default'] : null;
		
		return $item;
	}

	public function getTable($type = 'User', $prefix = 'EcuserTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
}