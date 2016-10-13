<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EctopicTableTopiccatObserver extends JTableObserver
{

	private $typeAliasPattern;

	public static function createObserver(JObservableInterface $observableObject, $parmas = array())
	{
		$observer = new self($observableObject);
		$observer->typeAliasPattern = $parmas['typeAlias'];
		return $observer;
	}

	public function onBeforeStore($updateNulls, $tableKey)
	{
		$this->table->modified = date('Y-m-d H:i:s');
	}
}