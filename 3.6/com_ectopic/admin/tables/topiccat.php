<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicTableTopiccat extends JTable	{
	
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_topiccat', 'topiccat', $_db);
	}
}