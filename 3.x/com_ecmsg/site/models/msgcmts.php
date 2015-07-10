<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgModelMsgcmts extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'msg', 'modified', 'search');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() { 
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('mc.msgcmt, mc.objtype, mc.objcat, mc.obj, mc.modified, 
			mc.msg, mc.user, mc.option, mc.body')
			->from('#__ec_msgcmt as mc');
		if($this->getState('joinUser'))
			$query->select('ju.name as ju_name')
			->join('INNER', '#__users as ju ON ju.id =mc.user');
		$order = $this->getState('order', false);
		if($order != false) $query->order($order);
		$obj = $this->getState('get.obj');
		$msg = $this->getState('get.msg');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($msg)) $msg = $this->getState('filter.msg');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($obj)) $query->where('mc.obj = '.(int)$obj);
		if(!empty($msg)) $query->where('mc.msg = '.(int)$msg);
		if(!empty($modified)) { //$query->order('mc.msgcmt DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('mc.modified >= "'.$modified.'"'); }
		if(!empty($search))
			$query->where('mc.body LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);
		return $query;
	}
}