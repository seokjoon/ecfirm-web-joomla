<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewItemAjax extends EcViewItem {
	
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->nameKey = $this->getName();
	}
	
	public function add() {
		$this->form = $this->get('Form', $this->nameKey.'form');
		$task = __function__;
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default_add.php';
		echo EcAjax::focus($this->nameKey.'_0 #jform_body');
		jexit();
	}
	
	public function addPre($exit = false) {
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default_addPre.php';
		if($exit) jexit();
	}

	public function cancel($valueKey) { $this->save($valueKey); }
	
	public function delete($valueKey) { //TODO echo JHtml::_('form.token');
		$params['optionCom'] = $this->optionCom;
		$params['nameKey'] = $this->nameKey;
		$params['valueKey'] = $valueKey;
		$params['task'] = 'deleteConfirm';
		echo EcWidget::confirmModal($params);
		jexit();
	}
	
	public function edit($valueKey) {
		$model = $this->getModel($this->getName().'form');
		$model->setState($this->nameKey, $valueKey);
		$this->form = $this->get('Form', $this->nameKey.'form');
		$availableTask = (1) ? true : false;
		$task = __function__;
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default_edit.php';
		echo EcAjax::focus($this->nameKey.'_'.$valueKey.' #jform_body');
		jexit();
	}
	
	public function save($valueKey) {
		if($valueKey == 0) {
			$params['order'] = 'desc';
			$params['where'] = array('user' => JFactory::getUser()->id);
			$valueKey = EcDml::selectByParams($params, $this->nameKey); 
		}
		$this->item = $this->getItem($valueKey);
		require_once JPATH_COMPONENT.'/views/'.$this->nameKey.'/tmpl/default.php';
		jexit();
	}
}