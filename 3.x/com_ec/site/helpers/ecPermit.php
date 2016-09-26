<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcPermit {
	
	public static function allowAdd($user = 0, $group = EcConst::USER_GROUP_REGISTERED) {
		if($user == 0) $user = JFactory::getUser()->id;
		$bool = EcUser::isGroup($group);
		return $bool;
	}
	
	public static function allowEdit($item = null, $user = 0) { //EcDebug::lp($item, true);
		if($user == 0) $user = JFactory::getUser()->id;
		if($item->user == $user) return true;
		else return false; //parent::allowEdit($data, $nameKey);
	}
}