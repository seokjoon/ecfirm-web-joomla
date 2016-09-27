<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once '../../3.x/com_ectopic/admin/tables/topicObserver.php';



class EctopicTableTopic extends EcTableAsset	{
	
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_topic', 'topic', $_db);
		EctopicTableTopicObserver::createObserver
			($this, array('typeAlias' => 'com_ectopic.topic'));
	}
}