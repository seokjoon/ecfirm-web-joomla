<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicModelTopics extends EcModelList	{ 

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('objcat', 'modified', 'search');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('t.topic, t.modified, t.objcat, t.user, t.title, t.attr, t.topiccmt, 
			t.topiclike, t.options, t.body, t.imgs, t.files')
			->from('#__ec_topic as t');
		if($this->getState('joinUser')) 
			$query->select('ju.name as ju_name')
				->join('INNER', '#__users as ju ON ju.id =t.user');
		$order = $this->getState('order', false);
		if($order != false) $query->order($order);
		$objcat = $this->getState('get.objcat');
		$modified = $this->getState('get.modified');
		if(empty($objcat)) $objcat = $this->getState('filter.objcat');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($objcat)) $query->where('t.objcat = "'.$objcat.'"');
		if(!empty($modified)) { //$query->order('t.topic DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('t.modified >= "'.$modified.'"'); 
		}
		if(!empty($search))
			$query->where('t.body LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);
		return $query;
	}
}