<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewItem extends EcViewLegacy {
	
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->nameKey = $this->getName();
	}
	
	public function add() {
		$this->form = $this->get('Form', $this->nameKey.'form');
		$optionCom = JFactory::getApplication()->input->get('option');
		$task = __function__;
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default_add.php';
		echo EcAjax::focus($this->nameKey.'_0_item #jform_body');
		jexit();
	}
	
	public function addPre($exit = false) {
		$optionCom = JFactory::getApplication()->input->get('option');
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default_addPre.php';
		if($exit) jexit();
	}

	public function cancel($valueKey) { $this->save($valueKey); }
	
	public function delete($valueKey) { //TODO echo JHtml::_('form.token');
		echo EcWidget::modalConfirm('com_ecmsg', $this->nameKey, $valueKey,
			array(''), 'item', 'deleteConfirm', false);
		jexit();
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
			return false; }
		parent::display($tpl);
	}
	
	public function edit($valueKey) {
		$model = $this->getModel($this->getName().'form');
		$model->setState($this->nameKey, $valueKey);
		$this->form = $this->get('Form', $this->nameKey.'form');
		$availableTask = (1) ? true : false;
		$optionCom = JFactory::getApplication()->input->get('option');
		$task = __function__;
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default_edit.php';
		echo EcAjax::focus($this->nameKey.'_'.$valueKey.'_item #jform_body');
		jexit();
	}
	
	protected function getItem($valueKey) {
		$model = $this->getModel($this->getName());
		$valueKey = ($valueKey == 0) ? 
			JFactory::getApplication()->input->getInt($this->nameKey) : $valueKey;
		$model->setState($this->nameKey, $valueKey);
		$item = $this->get('Item', $this->nameKey);
		$state = $this->get('State', $this->nameKey);
		if((isset($state->enabledPlugin)) && ($state->enabledPlugin)) {
			JPluginHelper::importPlugin('ec');
			$dispatcher = JEventDispatcher::getInstance();
			$item = $this->eventPlugin($dispatcher, $item); }
		return $item;
	}

	public function save($valueKey) {
		if($valueKey == 0) {
			$params['order'] = 'desc';
			$params['where'] = array('user' => JFactory::getUser()->id);
			$valueKey = EcDml::selectByParams($params, $this->nameKey); }
		$this->item = $this->getItem($valueKey);
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default.php';
		jexit();
	}
}