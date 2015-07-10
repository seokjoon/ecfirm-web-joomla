<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EccontModelContlikes extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'cont', 'modified');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('cl.contlike, cl.objtype, cl.objcat, cl.obj, cl.modified, 
			cl.cont, cl.user')
			->from('#__ec_contlike as cl');
		$obj = $this->getState('get.obj');
		$cont = $this->getState('get.cont');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($cont)) $cont = $this->getState('filter.cont');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		if(!empty($obj)) $query->where('cl.obj = '.(int)$obj);
		if(!empty($cont)) $query->where('cl.cont = '.(int)$cont);
		if(!empty($modified)) { //$query->order('cl.contlike DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('cl.modified >= "'.$modified.'"'); }
		//$this->setError($query);
		return $query;
	}
}