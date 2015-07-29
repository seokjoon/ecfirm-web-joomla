<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserModelAddressform extends EcModelForm	{
	
	public function getItem($keyValue = null)	{ //EcDebug::log(__method__);
		$valueKey = JFactory::getApplication()->input->get('user', 0, 'uint');
		$this->setState($this->nameKey, $valueKey);
		return parent::getItem($keyValue);
	}

	public function getTable($type = 'User', $prefix = 'EcuserTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
}