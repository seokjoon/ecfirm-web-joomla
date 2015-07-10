<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgControllerMsg extends EcControllerAjax {
	
	public function t1() { //EcDebug::lp(__method__);
		$ctrMsg = EcmsgFactory::getControllerInnerMsg(); //$ctrMsg->test();
		$model = $ctrMsg->getModel();
		//EcDebug::lp($model);
	}

}