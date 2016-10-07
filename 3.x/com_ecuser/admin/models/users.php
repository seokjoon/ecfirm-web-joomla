<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserModelUsers extends EcModelListAdmin	{ 

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);

		if(empty($this->keywords))
			$this->keywords = array('modified', 'search');
	}
	
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		
		$query->select('u.user, u.modified, u.term, u.options, u.profiles, u.imgs, u.urls')
			->from('#__ec_user as u');
		$query->select('ju.username as username, ju.name as name,
			ju.email as email, ju.block as block, ju.sendEmail as sendEmail, 
			ju.registerDate as registerDate, ju.lastvisitDate as lastvisitDate, 
			ju.activation as activation')
			->join('INNER', '#__users as ju ON ju.id = u.user');
		$query->order('u.user DESC');
		
		$modified = $this->getState('get.modified');
		if(empty($modified)) $modified = $this->getState('filter.modified');
		$search = $this->getState('filter.search');
		if(!empty($modified)) { 
			if(is_numeric($modified)) $modified = date('Y-m-d H:i:s', $modified);
			$query->where('u.modified >= "'.$modified.'"'); 
		}
		if(!empty($search)) $query->where('ju.username LIKE '.$db->quote('%'.$search.'%'));
		//$this->setError($query);

		return $query;
	}
}