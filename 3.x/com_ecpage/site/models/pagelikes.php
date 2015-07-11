<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcpageModelPagelikes extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'page', 'modified');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('pl.pagelike, pl.objtype, pl.objcat, pl.obj, pl.modified, 
			pl.page, pl.user')
			->from('#__ec_pagelike as pl');
		$obj = $this->getState('get.obj');
		$page = $this->getState('get.page');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($page)) $page = $this->getState('filter.page');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		if(!empty($obj)) $query->where('pl.obj = '.(int)$obj);
		if(!empty($page)) $query->where('pl.page = '.(int)$page);
		if(!empty($modified)) { //$query->order('pl.pagelike DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('pl.modified >= "'.$modified.'"'); }
		//$this->setError($query);
		return $query;
	}
}