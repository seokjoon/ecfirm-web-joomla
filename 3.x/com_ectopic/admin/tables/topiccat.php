<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once '../../3.7/com_ectopic/admin/tables/topiccatObserver.php';



class EctopicTableTopiccat extends JTable	{
	
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_topiccat', 'topiccat', $_db);
		EctopicTableTopiccatObserver::createObserver
			($this, array('typeAlias' => 'com_ectopic.topiccat'));
	}
}