<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserModelAccountform extends EcModelForm	{
	
	public function getItem($keyValue = null)	{ 
		$valueKey = JFactory::getApplication()->input->get('user', 0, 'uint');
		$this->setState($this->nameKey, $valueKey); 
		$item = parent::getItem($keyValue); //EcDebug::lp($item);
		
		//TODO check line 12, 13
		
		if(empty($item)) return $item;
		if((JFactory::getUser()->id) != ($item->user)) return false;
		if($item->user > 0) {
			$table = $this->getTable('User', 'JTable');
			$table->load($item->user); //EcDebug::log($table);
			$item->username = $table->username;
			$item->email = $table->email; 
		} //EcDebug::lp($item);
		return $item;
	}

	//TODO check getTable()
	
	public function getTable($type = 'User', $prefix = 'EcuserTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);		
	}	
}