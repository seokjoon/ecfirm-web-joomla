<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcprodControllerInnerProd extends EcControllerLegacy {
	
	public function t1() { //EcDebug::lp(__method__);
		$ctrProd = EcprodFactory::getControllerInnerProd(); //$ctrProd->test();
		$model = $ctrProd->getModel();
		//EcDebug::lp($model);
	}

}