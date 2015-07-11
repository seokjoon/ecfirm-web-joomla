<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcpageFactory {
	public static $ctrPage = null;
	
	public static function getControllerInnerPage() {
		if(!self::$ctrPage) self::$ctrPage =
			EcpageControllerInnerPage::getInstance('ecpage', 'page');
		return self::$ctrPage;
	}
}