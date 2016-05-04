<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicModelTopiclikes extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('topic', 'modified');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('tl.topiclike, tl.modified, tl.objcat, tl.topic, tl.user')
			->from('#__ec_topiclike as tl');
		$topic = $this->getState('get.topic');
		$modified = $this->getState('get.modified');
		if(empty($topic)) $topic = $this->getState('filter.topic');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		if(!empty($topic)) $query->where('tl.topic = '.(int)$topic);
		if(!empty($modified)) { //$query->order('tl.topiclike DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('tl.modified >= "'.$modified.'"'); 
		}
		//$this->setError($query);
		return $query;
	}
}