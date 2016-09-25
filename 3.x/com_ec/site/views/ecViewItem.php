<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewItem extends EcViewLegacy {
	protected $form;
	
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->nameKey = $this->getName();
		$this->plural = false;
	}
	
	/**
	 * Execute and display a template script.
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 * @return  mixed  A string if successful, otherwise a Error object. */
	public function display($tpl = null) {
		$this->item = $this->getItem(0); //$this->item = $this->get('Item');
		//$this->return = $this->get('ReturnPage');
		if(count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false; 
		}
		parent::display($tpl);
	}
	
	protected function getItem($valueKey) {
		$model = $this->getModel($this->getName());
		$valueKey = ($valueKey == 0) ? 
			JFactory::getApplication()->input->getInt($this->nameKey) : $valueKey;
		$model->setState($this->nameKey, $valueKey);
		$item = $this->get('Item', $this->nameKey);
		if(empty($item)) return $item;
		$state = $this->get('State', $this->nameKey);
		if((isset($state->enabledPlugin)) && ($state->enabledPlugin)) {
			JPluginHelper::importPlugin(EcConst::getPrefix());//('ec');
			$dispatcher = JEventDispatcher::getInstance();
			$item = $this->eventPlugin($dispatcher, $item); 
		}
		return $item;
	}
}