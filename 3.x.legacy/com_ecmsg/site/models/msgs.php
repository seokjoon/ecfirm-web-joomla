<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgModelMsgs extends EcModelList	{ 

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
		$query->select('m.msg, m.objtype, m.objcat, m.obj, m.modified, m.enable, 
			m.featured, m.user, m.msgcmt, m.msglike, m.imgs, m.options, m.body')
			->from('#__ec_msg as m');
		if($this->getState('joinUser')) 
			$query->select('ju.name as ju_name')
				->join('INNER', '#__users as ju ON ju.id =m.user');
		$order = $this->getState('order', false);
		if($order != false) $query->order($order);
		$obj = $this->getState('get.obj');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($obj)) $query->where('m.obj = '.(int)$obj);
		if(!empty($modified)) { //$query->order('m.msg DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('m.modified >= "'.$modified.'"'); }
		if(!empty($search))
			$query->where('m.body LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);
		return $query;
	}
}