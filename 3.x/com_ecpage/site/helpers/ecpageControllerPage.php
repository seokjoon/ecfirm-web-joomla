<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcpageControllerInnerPage extends EcControllerLegacy {
	
	public function t1() { //EcDebug::lp(__method__);
		$ctrPage = EcpageFactory::getControllerInnerPage(); //$ctrPage->test();
		$model = $ctrPage->getModel();
		//EcDebug::lp($model);
	}

}