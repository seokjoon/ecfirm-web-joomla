<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicControllerTopiccmt extends EcControllerAjax {

	public function delete() { 
		$data = $this->input->post->get('jform', array(), 'array');//EcDebug::log($data);
		$nameKey = $this->nameKey;
		$valueKey = $data[$nameKey];
		$nameCol = 'topic';
		$valueCol = $data[$nameCol];
		$asset = $this->option.'.'.$nameKey.'.'.$valueKey;
		if(!(JFactory::getUser()->authorise('core.delete', $asset))) jexit('false');
		$this->input->set($nameCol, $valueCol);
		if(!(EcControllerLegacy::delete())) jexit('false');
		$view = $this->getView($this->default_view.'s', JFactory::getDocument()->getType());
		$view->setModel($this->getModel($nameKey.'form'));
		$view->setModel($this->getModel($nameKey.'s'));
		$view->setModel($this->getModel($nameCol));
		$view->show($valueCol);
	}
	
	public function save($nameKey = null, $urlVar = null) {
		$nameKey = (empty($nameKey)) ? $this->nameKey : $nameKey;
		$data = $this->input->post->get('jform', array(), 'array');
		$nameCol = 'topic';
		$valueCol = $data[$nameCol];
		$this->input->set($nameCol, $valueCol);
		if(!(EcControllerLegacy::save($nameKey, $urlVar))) jexit('false');
		$view = $this->getView($this->default_view.'s', JFactory::getDocument()->getType());
		$view->setModel($this->getModel($nameKey.'form'));
		$view->setModel($this->getModel($nameKey.'s'));
		$view->setModel($this->getModel($nameCol));
		$view->show($valueCol);
	}
}