<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcHelperTopiccat extends EcHelperTopic
{

	public static function getStateValues()
	{
		return array(
			'' => JText::_('COM_ECTOPIC_TOPICCAT_STATE_VALUE_SELECT'),
			'2' => JText::_('COM_ECTOPIC_TOPICCAT_STATE_VALUE_S2'),
			'1' => JText::_('COM_ECTOPIC_TOPICCAT_STATE_VALUE_S1')
		);
	}
}