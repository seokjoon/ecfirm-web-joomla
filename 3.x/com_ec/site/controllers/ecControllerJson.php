<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcControllerJson extends EcControllerLegacy
{

	/**
	 * Method to add a new record.
	 * @return  mixed  True if the record can be added, a error object if not.
	 * @since   12.2 JControllerForm
	 */
	public function add()
	{
		echo new JResponseJson(null, null, ! (parent::add()));
	}

	/**
	 * Method to cancel an edit.
	 * @param   string  $nameKey  The name of the primary key of the URL variable.
	 * @return  boolean  True if access level checks pass, false otherwise.
	 * @since   12.2 JControllerForm
	 */
	public function cancel($nameKey = null)
	{
		echo new JResponseJson(null, null, ! (parent::cancel()));
	}

	/** * Removes an item.
	 * @return  void
	 * @since   12.2 JControllerAdmin
	 */
	public function delete()
	{
		echo new JResponseJson(null, null, ! (parent::delete()));
	}

	public function display($cachable = false, $urlparams = array())
	{
		if (substr($this->entity, - 1) == 's')
			return $this->getItems();
		else
			return $this->getItem();
	}

	/**
	 * Method to edit an existing record.
	 * @param   string  $nameKey     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key
	 * (sometimes required to avoid router collisions).
	 * @return  boolean  True if access level check and checkout passes, false otherwise.
	 * @since   12.2 JControllerForm
	 */
	public function edit($nameKey = null, $urlVar = null)
	{
		echo new JResponseJson(null, null, ! (parent::edit($nameKey, $urlVar)));
	}

	public function getFile()
	{}

	public function getFiles()
	{}

	public function getItem($valueKey = 0, $nameKey = '')
	{
		$item = parent::getItem($valueKey, $nameKey);
		
		if (is_object($item))
			echo new JResponseJson($item);
		else 
			if (is_bool($item))
				echo new JResponseJson(null, null, ! $item);
	}

	public function getItems($name = null)
	{
		$items = parent::getItems($name);
		
		if (is_array($items))
			echo new JResponseJson($items);
		else 
			if (is_bool($items))
				echo new JResponseJson(null, null, ! $items);
	}

	/**
	 * Method to save a record.
	 * @param   string  $nameKey     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 * @return  boolean  True if successful, false otherwise.
	 * @since   12.2 JControllerForm
	 */
	public function save($nameKey = null, $urlVar = null)
	{
		echo new JResponseJson(null, null, ! (parent::save($nameKey, $urlVar)));
	}

	protected function setRedirectParams($params = array())
	{
		$params['format'] = 'json';
		
		parent::setRedirectParams($params);
	}
}