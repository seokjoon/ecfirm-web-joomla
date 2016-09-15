<?php /** @package ecfirm.net
 * @copyright Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicModelTopiccat extends EcModelItemAdmin {
	
	public function getTable($type = 'Topiccat', $prefix = 'EctopicTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
}