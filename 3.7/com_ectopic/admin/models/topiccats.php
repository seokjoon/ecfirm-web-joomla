<?php /** @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicModelTopiccats extends EcModelListAdmin	{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array()) {
		parent::__construct($config);
		if(empty($this->keywords))
			$this->keywords = array('state', 'search');
	}

	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('tc.topiccat, tc.modified, tc.parent, tc.state, tc.title')
			->from('#__ec_topiccat as tc');
		$state = $this->getState('get.state');
		if(empty($state)) $state = $this->getState('filter.state');
		if(!empty($state)) $query->where('tc.state = '.$db->quote($state));
		if(!empty($search)) $query->where('tc.title LIKE '.$db->quote('%'.$search.'%'));
		////////
		//$this->setError($query);
		return $query;
	}
}