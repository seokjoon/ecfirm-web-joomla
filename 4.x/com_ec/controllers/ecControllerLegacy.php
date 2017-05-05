<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcControllerLegacy extends JControllerLegacy
{

	protected $entity; //ex) examples or example(plural or singular)

	protected $option; //ex) com_ecexample

	protected $nameKey; //ex) example

	public function __construct($config = array())
	{
		parent::__construct($config);

		$classNameArray = explode('Controller', get_called_class());
		$this->entity = strtolower($classNameArray[1]);
		$this->nameKey = (substr($this->entity, - 1) == 's') ? substr($this->entity, 0, - 1) : $this->entity;
		$this->option = 'com_' . strtolower($this->getName());
	}



}