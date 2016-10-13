<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EctopicModelTopiccmt extends EcModelItem
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
}