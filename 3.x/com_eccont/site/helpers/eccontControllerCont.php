<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EccontControllerInnerCont extends EcControllerLegacy {
	
	public function t1() { //EcDebug::lp(__method__);
		$ctrCont = EccontFactory::getControllerInnerCont(); //$ctrCont->test();
		$model = $ctrCont->getModel();
		//EcDebug::lp($model);
	}

}