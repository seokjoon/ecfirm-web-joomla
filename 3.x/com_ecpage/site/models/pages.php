<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcpageModelPages extends EcModelList	{ 

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'modified', 'search');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('p.page, p.objtype, p.objcat, p.obj, p.modified, p.title, p.user, 
			p.pagelike, p.option, p.body')
			->from('#__ec_page as p');
		if($this->getState('joinUser')) 
			$query->select('ju.name as ju_name')
				->join('INNER', '#__users as ju ON ju.id =p.user');
		$order = $this->getState('order', false);
		if($order != false) $query->order($order);
		$obj = $this->getState('get.obj');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($obj)) $query->where('p.obj = '.(int)$obj);
		if(!empty($modified)) { //$query->order('p.page DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('p.modified >= "'.$modified.'"'); }
		if(!empty($search))
			$query->where('p.body LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);
		return $query;
	}
}