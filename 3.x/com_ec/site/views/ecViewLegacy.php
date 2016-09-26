<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcViewLegacy extends JViewLegacy {
	protected $allow = array();
	protected $context;
	protected $item;
	protected $optionCom;
	protected $nameKey;
	protected $params;
	protected $plural;
	//protected $user; DELETE ME
	
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->optionCom = JFactory::getApplication()->input->get('option');
	}
	
	public function display($tpl = null) {
		$classNameArray = explode('View', get_called_class());
		$this->context = 'com_'.strtolower($classNameArray[0]).'.'.$this->nameKey;
		$this->params = JFactory::getApplication()->getParams();//$this->get('State')->get('params);
		//$this->user = JFactory::getUser(); //DELETE ME
		parent::display($tpl);
	}
	
	protected function eventPlugin($dispatcher, &$item) {
		$dispatcher->trigger('on'.ucfirst($this->nameKey).'PrepareDisplay',
			array($this->context, &$item));
		$item->event = new stdClass;
		$results = $dispatcher->trigger('on'.ucfirst($this->nameKey).'BeforeDisplay',
			array($this->context, &$item));
		$item->event->beforeDisplay = trim(implode($results));
		$results = $dispatcher->trigger('on'.ucfirst($this->nameKey).'AfterDisplay',
			array($this->context, &$item));
		$item->event->afterDisplay = trim(implode($results));
		return $item;
	}
	
	public function getAllow() { return $this->allow; }
	
	public function setAllow($params = array()) {
		$this->allow['add'] = $params['add'];
		$this->allow['edit'] = $params['edit'];
	}
}