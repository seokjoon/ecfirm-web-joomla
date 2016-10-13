<?php

/**
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EctopicModelTopic extends EcModelItem
{

	/**
	 * Method to test whether a record can be deleted.
	 * @param   object  $record  A record object.
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission for the component.
	 * @since   12.2 JModelAdmin */
	protected function canDelete($record)
	{
		return $record->user == JFactory::getUser()->id;
	}

	/** Method to get article data.
	 * @param   integer  $itemId  The id of the article.
	 * @return  mixed  Content item data object on success, false on failure.
	 * @since 12.2 JModelAdmin */
	public function getItem($valueKey = null)
	{
		$item = parent::getItem($valueKey);
		if (empty($item))
			return $item;
		if ($item->user > 0) {
			$table = $this->getTable('User', 'JTable');
			$table->load($item->user);
			$item->username = $table->username;
		}
		if ($item->topiccat > 0) {
			$table = $this->getTable('Topiccat', 'EctopicTable');
			$table->load($item->topiccat);
			$item->topiccatTitle = $table->title;
		}
		return $item;
	}
}