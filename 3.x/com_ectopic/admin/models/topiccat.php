<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EctopicModelTopiccat extends EcModelItemAdmin
{

	public function getTable($type = 'Topiccat', $prefix = 'EctopicTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
}