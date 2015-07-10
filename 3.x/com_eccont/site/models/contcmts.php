<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EccontModelContcmts extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'cont', 'modified', 'search');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() { 
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('cc.contcmt, cc.objtype, cc.objcat, cc.obj, cc.modified, 
			cc.cont, cc.user, cc.option, cc.body')
			->from('#__ec_contcmt as cc');
		if($this->getState('joinUser'))
			$query->select('ju.name as ju_name')
			->join('INNER', '#__users as ju ON ju.id =cc.user');
		$order = $this->getState('order', false);
		if($order != false) $query->order($order);
		$obj = $this->getState('get.obj');
		$cont = $this->getState('get.cont');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($cont)) $cont = $this->getState('filter.cont');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($obj)) $query->where('cc.obj = '.(int)$obj);
		if(!empty($cont)) $query->where('cc.cont = '.(int)$cont);
		if(!empty($modified)) { //$query->order('cc.contcmt DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('cc.modified >= "'.$modified.'"'); }
		if(!empty($search))
			$query->where('cc.body LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);
		return $query;
	}
}