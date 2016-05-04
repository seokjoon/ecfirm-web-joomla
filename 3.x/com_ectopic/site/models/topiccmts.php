<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicModelTopiccmts extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('topic', 'modified', 'search');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() { 
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('tc.topiccmt, tc.modified, tc.objcat, tc.topic, tc.user, 
			tc.options, tc.body')
			->from('#__ec_topiccmt as tc');
		if($this->getState('joinUser'))
			$query->select('ju.name as ju_name')
			->join('INNER', '#__users as ju ON ju.id =tc.user');
		$order = $this->getState('order', false);
		if($order != false) $query->order($order);
		$topic = $this->getState('get.topic');
		$modified = $this->getState('get.modified');
		if(empty($topic)) $topic = $this->getState('filter.topic');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($topic)) $query->where('tc.topic = '.(int)$topic);
		if(!empty($modified)) { //$query->order('tc.topiccmt DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('tc.modified >= "'.$modified.'"'); 
		}
		if(!empty($search))
			$query->where('tc.body LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);
		return $query;
	}
}