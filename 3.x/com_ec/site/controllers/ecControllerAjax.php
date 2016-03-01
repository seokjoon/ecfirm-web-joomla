<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcControllerAjax extends EcControllerLegacy {
	
	public function __construct($config = array()) {
		parent::__construct($config);
		if(!isset($config['default_view'])) $this->default_view = $this->entity;
	}
	
	public function add() {
		if(!(parent::add())) jexit('false');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($this->nameKey.'form'));
		$view->add();
	}

	public function addFail() {
		$return = $this->getRedirectLogin();
		echo '<script>window.location.href="'.$return.'"</script>';
		jexit();
	}
	
	/**
	 * @todo: move to child */
	public function addPre() {
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->addPre(true);
	}
	
	public function cancel($nameKey = null) {
		$nameKey = (empty($nameKey)) ? $this->nameKey : $nameKey;
		if(!(parent::cancel($nameKey))) jexit('false');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel());
		$valueKey = $this->input->post->get($nameKey, 0, 'uint');
		$view->cancel($valueKey);
	}
	
	public function delete() { //EcDebug::log($this->input->post->get('jform', array(), 'array'));
		$nameKey = $this->nameKey;
		$valueKey = $this->input->get($nameKey, 0, 'uint');
		$asset = $this->option.'.'.$this->nameKey.'.'.$valueKey;
		if(!(JFactory::getUser()->authorise('core.delete', $asset))) jexit('false');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel());
		$view->delete($valueKey);
	}
	
	public function deleteConfirm() {
		if(!(parent::delete())) jexit('false');
		jexit();
	}
	
	public function edit($nameKey = null, $urlVar = null) {
		$nameKey = (empty($nameKey)) ? $this->nameKey : $nameKey;
		if(!(parent::edit($nameKey, $urlVar))) jexit('false');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($nameKey.'form'));
		$valueKey = $this->input->post->get($nameKey, 0, 'uint');
		$view->edit($valueKey);
	}

	public function save($nameKey = null, $urlVar = null) {
		$nameKey = (empty($nameKey)) ? $this->nameKey : $nameKey;
		if(!(parent::save($nameKey, $urlVar))) jexit('false');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel());
		$valueKey = $this->input->post->get($nameKey, 0, 'uint');
		$view->save($valueKey);
	}
}