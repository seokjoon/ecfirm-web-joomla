<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcFactory {
	public static $controllerInnerMsg = null;
	
	public static function getControllerInnerDml() {
		if(!self::$controllerInnerMsg) self::$controllerInnerMsg =
			EcControllerInnerDml::getInstance('msg');
		return self::$controllerInnerMsg;
	}
}