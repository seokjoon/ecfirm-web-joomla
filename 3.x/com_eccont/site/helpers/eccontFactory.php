<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EccontFactory {
	public static $ctrCont = null;
	
	public static function getControllerInnerCont() {
		if(!self::$ctrCont) self::$ctrCont =
			EccontControllerInnerCont::getInstance('eccont', 'cont');
		return self::$ctrCont;
	}
}