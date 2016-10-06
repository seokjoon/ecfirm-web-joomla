<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserConst {
	
	const ACTIVATE_TYPE = array(
		0 => self::ACTIVATE_TYPE_NONE,
		1 => self::ACTIVATE_TYPE_USER,
		2 => self::ACTIVATE_TYPE_ADMIN
	);
	const ACTIVATE_TYPE_ADMIN = 'adminactivate';
	const ACTIVATE_TYPE_NONE = 'none';
	const ACTIVATE_TYPE_USER = 'useractivate';
}