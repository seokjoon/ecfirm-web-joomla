<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcuserModelDeleteform extends EcModelForm
{

	public function getTable($type = 'User', $prefix = 'EcuserTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
}