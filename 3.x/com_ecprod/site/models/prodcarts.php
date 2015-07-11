<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcprodModelProdcarts extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'prod', 'modified');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('pdc.prodcart, pdc.objtype, pdc.objcat, pdc.obj, pdc.modified, 
			pdc.prod, pdc.user')
			->from('#__ec_prodcart as pdc');
		$obj = $this->getState('get.obj');
		$prod = $this->getState('get.prod');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($prod)) $prod = $this->getState('filter.prod');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		if(!empty($obj)) $query->where('pdc.obj = '.(int)$obj);
		if(!empty($prod)) $query->where('pdc.prod = '.(int)$prod);
		if(!empty($modified)) { //$query->order('pdc.prodcart DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('pdc.modified >= "'.$modified.'"'); }
		//$this->setError($query);
		return $query;
	}
}