<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserModelUserlikes extends EcModelList	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('obj', 'user', 'modified');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('ul.userlike, ul.objtype, ul.objcat, ul.obj, ul.modified, 
			ul.userTrg, ul.userSrc')
			->from('#__ec_userlike as ul');
		$obj = $this->getState('get.obj');
		$user = $this->getState('get.user');
		$modified = $this->getState('get.modified');
		if(empty($obj)) $obj = $this->getState('filter.obj');
		if(empty($user)) $user = $this->getState('filter.user');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		if(!empty($obj)) $query->where('ul.obj = '.(int)$obj);
		if(!empty($user)) $query->where('ul.user = '.(int)$user);
		if(!empty($modified)) { //$query->order('ul.userlike DESC');
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('ul.modified >= "'.$modified.'"'); }
		//$this->setError($query);
		return $query;
	}
}