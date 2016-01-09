<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EctopicFactory {
	public static $ctrTopic = null;
	
	public static function getControllerInnerTopic() {
		if(!self::$ctrTopic) self::$ctrTopic =
			BpTopicControllerInner::getInstance('ectopic', 'topic');
		return self::$ctrTopic;
	}
}