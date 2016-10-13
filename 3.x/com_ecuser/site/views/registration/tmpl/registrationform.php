<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

if (! JFactory::getUser()->guest)
	jexit(JText::_('COM_ECUSER_REGISTRATION_ALREADY_LOGGED_IN'));
$userConf = JComponentHelper::getParams('com_users');
$availableRegistration = ($userConf->get('allowUserRegistration')) ? true : false;
if ($availableRegistration) {
	if (1)
		echo $this->loadTemplate('register');
	else
		echo $this->loadTemplate('activate');
} else
	echo $this->loadTemplate('not_allowed');