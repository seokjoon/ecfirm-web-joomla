<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcFactory {
	public static $controllerInnerProd = null;
	
	public static function getControllerInnerDml() {
		if(!self::$controllerInnerProd) self::$controllerInnerProd =
			EcControllerInnerDml::getInstance('prod');
		return self::$controllerInnerProd;
	}
}