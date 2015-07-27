<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserModelProfileform extends EcModelForm	{
	
	public function getItem($keyValue = null)	{ //EcDebug::log(__method__);
		$item = parent::getItem($keyValue); 
		if(empty($item)) return $item;
		if(($this->getState('joinUser')) && ($item->user > 0)) {
			$table = $this->getTable('User', 'JTable');
			$table->load($item->user); //EcDebug::log($table);
			$item->name = $table->name; } //EcDebug::lp($item);
		return $item;
	}
}