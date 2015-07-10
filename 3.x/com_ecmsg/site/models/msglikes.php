<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgModelMsglikes extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'msg', 'modified');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('ml.msglike, ml.objtype, ml.objcat, ml.obj, ml.modified, 
			ml.msg, ml.user')
			->from('#__ec_msglike as ml');
		$obj = $this->getState('get.obj');
		$msg = $this->getState('get.msg');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($msg)) $msg = $this->getState('filter.msg');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		if(!empty($obj)) $query->where('ml.obj = '.(int)$obj);
		if(!empty($msg)) $query->where('ml.msg = '.(int)$msg);
		if(!empty($modified)) { //$query->order('ml.msglike DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('ml.modified >= "'.$modified.'"'); }
		//$this->setError($query);
		return $query;
	}
}