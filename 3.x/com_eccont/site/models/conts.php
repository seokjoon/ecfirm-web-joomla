<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EccontModelConts extends EcModelList	{ 

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
		$query->select('c.cont, c.objtype, c.objcat, c.obj, c.modified, c.enable, 
			c.featured, c.user, c.contcmt, c.contlike, c.imgs, c.options, c.body')
			->from('#__ec_cont as c');
		if($this->getState('joinUser')) 
			$query->select('ju.name as ju_name')
				->join('INNER', '#__users as ju ON ju.id =c.user');
		$order = $this->getState('order', false);
		if($order != false) $query->order($order);
		$obj = $this->getState('get.obj');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($obj)) $query->where('c.obj = '.(int)$obj);
		if(!empty($modified)) { //$query->order('c.cont DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('c.modified >= "'.$modified.'"'); 
		}
		if(!empty($search))
			$query->where('c.body LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);
		return $query;
	}
}