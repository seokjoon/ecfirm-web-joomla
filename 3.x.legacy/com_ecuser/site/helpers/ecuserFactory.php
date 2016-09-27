<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcuserFactory {
	public static $ctrUser = null;
	
	public static function getControllerInnerUser() {
		if(!self::$ctrUser) self::$ctrUser =
			EcuserControllerInnerUser::getInstance('ecuser', 'user');
		return self::$ctrUser;
	}
}