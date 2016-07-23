<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');


/**
 * @deprecated */
class EcControllerCmt extends EcControllerAjax {
	protected $cmtType = '';
	
	/**
	 * singular */
	public function delete() {
		$data = $this->input->post->get('jform', array(), 'array');//EcDebug::log($data);
		$nameKey = $this->nameKey;
		$valueKey = $data[$nameKey];
		$nameCol = $this->cmtType;
		$valueCol = $data[$nameCol];
		$asset = $this->option.'.'.$nameKey.'.'.$valueKey;
		//if(!(JFactory::getUser()->authorise('core.delete', $asset))) jexit('false');
		$this->input->set($nameCol, $valueCol);
		//if(!(EcControllerLegacy::delete())) jexit('false');
		$view = $this->getView($this->default_view.'s', JFactory::getDocument()->getType());
		$view->setModel($this->getModel($nameKey.'form'));
		$view->setModel($this->getModel($nameKey.'s'));
		$view->setModel($this->getModel($nameCol));
		//$view->show($valueCol);
		if(EcControllerLegacy::delete()) $view->show($valueCol);
		else $view->writeFail($valueCol);
	}
	
	/**
	 * plural */
	public function hide() {
		$nameCol = $this->cmtType;
		$data = $this->input->post->get('jform', array(), 'array');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($this->entity));
		$view->setModel($this->getModel($nameCol));
		$view->hide($data[$nameCol]);
	}

	/**
	 * singular */
	public function save($nameKey = null, $urlVar = null) {
		$nameKey = (empty($nameKey)) ? $this->nameKey : $nameKey;
		$data = $this->input->post->get('jform', array(), 'array');
		$nameCol = $this->cmtType;
		$valueCol = $data[$nameCol];
		$this->input->set($nameCol, $valueCol);
		$view = $this->getView($this->default_view.'s', JFactory::getDocument()->getType());
		$view->setModel($this->getModel($nameKey.'form'));
		$view->setModel($this->getModel($nameKey.'s'));
		$view->setModel($this->getModel($nameCol));
		if(EcControllerLegacy::save($nameKey, $urlVar)) $view->show($valueCol);
		else $view->writeFail($valueCol);
	}
	
	/**
	 * plural */
	public function show() {
		$nameCol = $this->cmtType;
		$data = $this->input->post->get('jform', array(), 'array');
		$this->input->set($nameCol, $data[$nameCol]);
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($this->nameKey.'form'));
		$view->setModel($this->getModel($this->entity));
		$view->setModel($this->getModel($nameCol));
		$view->show($data[$nameCol]);
	}
}