<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserHelper {
	
	public static function getUsergroupTitle() {
		return array(
			1 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_PUBLIC'),
			9 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_GUEST'),
			////////
			2 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_REGISTERED'),
			3 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_AUTHOR'),
			4 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_EDITOR'),
			5 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_PUBLISHER'),
			////////
			6 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_MANAGER'),
			7 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_ADMINISTRATOR'),
			////////
			8 => JText::_('COM_ECUSER_USER_USERGROUP_VALUE_SUPERUSERS'),
		);
	}
}