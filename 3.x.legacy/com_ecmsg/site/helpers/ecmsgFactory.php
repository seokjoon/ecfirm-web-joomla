<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcmsgFactory {
	public static $ctrMsg = null;
	
	public static function getControllerInnerMsg() {
		if(!self::$ctrMsg) self::$ctrMsg =
			EcmsgControllerInnerMsg::getInstance('ecmsg', 'msg');
		return self::$ctrMsg;
	}
}