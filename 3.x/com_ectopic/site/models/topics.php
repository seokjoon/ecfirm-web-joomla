<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EctopicModelTopics extends EcModelList
{

	/**
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JModelLegacy
	 * @since   12.2 JModelList */
	public function __construct($config = array())
	{
		parent::__construct($config);
		if (empty($this->keywords))
			$this->keywords = array(
				'topiccat',
				'order',
				'modified',
				'search'
			);
	}

	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 * @since   12.2 JModelList */
	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('topic, modified, created, topiccat, user, state, title, hits, topiccmt, topiclike, options, body, imgs, files')
			->from('#__ec_topic as t');
		$query->select('ju.username as username')->join('INNER', '#__users as ju ON ju.id =t.user');
		
		$app = JFactory::getApplication();
		$input = $app->input;
		
		$order = $this->getState('get.order');
		if (empty($order))
			$order = $this->getState('filter.order');
		if (! empty($order)) {
			$query->order($order);
			$app->setUserState('com_ectopic.topics.order', $order);
		} else
			$query->order('t.topic DESC');
		
		$topiccat = $this->getState('get.topiccat');
		if (empty($topiccat))
			$topiccat = $this->getState('filter.topiccat');
		if (! empty($topiccat)) {
			$query->where('t.topiccat = "' . $topiccat . '"');
			$app->setUserState('com_ectopic.topics.topiccat', $topiccat);
		}
		
		$modified = $this->getState('get.modified');
		if (empty($modified))
			$modified = $this->getState('filter.modified');
		if (! empty($modified)) {
			if (is_numeric($modified))
				$modified = date('Y-m-d H:i:s', $modified);
			$query->where('t.modified >= "' . $modified . '"');
		}
		
		$search = $this->getState('filter.search');
		if (! empty($search))
			$query->where('t.title LIKE ' . $db->quote('%' . $search . '%') . ' OR t.body LIKE ' . $db->quote('%' . $search . '%'));
			
		//$this->setError($query);
		return $query;
	}
}