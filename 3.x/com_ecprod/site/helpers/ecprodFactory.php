<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcprodFactory {
	public static $ctrProd = null;
	
	public static function getControllerInnerProd() {
		if(!self::$ctrProd) self::$ctrProd =
			EcprodControllerInnerProd::getInstance('ecprod', 'prod');
		return self::$ctrProd;
	}
}