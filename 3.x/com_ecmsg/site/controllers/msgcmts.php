<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgControllerMsgcmts extends EcControllerAjax {
	
	public function hide() {
		$data = $this->input->post->get('jform', array(), 'array');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($this->entity));
		$view->setModel($this->getModel('msg'));
		$view->hide($data['msg']);
	}
	
	public function show() {
		$data = $this->input->post->get('jform', array(), 'array');
		$this->input->set('msg', $data['msg']);
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($this->nameKey.'form'));
		$view->setModel($this->getModel($this->entity));
		$view->setModel($this->getModel('msg'));
		$view->show($data['msg']);
	}
}