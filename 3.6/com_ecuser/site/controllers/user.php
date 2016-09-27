<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerUser extends EcControllerForm {
	
	protected function allowEdit($data = array(), $nameKey = null) {
		if(empty($data)) $data['user'] = $this->input->get('user', 0, 'uint');
		if($data['user'] == (JFactory::getUser()->id)) return true;
		else return parent::allowEdit($data, $nameKey);
	}
	
	public function editAccount() {
		$this->input->set('layout', 'account');
		$this->edit();
	}
	
	public function editForm() {
		//TODO internal redirect check
		$layout = $this->input->get('layout', null, 'string');
		$nameModelForm = (empty($layout)) ? $this->nameKey.'form' : $layout.'form';
		$layout = (empty($layout)) ? 'edit' : 'edit_'.$layout; //BmDebug::log($layout, __method__);
		$view = $this->getView($this->default_view,
			JFactory::getDocument()->getType(), '', array('layout' => $layout));
		$view->setModel($this->getModel($this->nameKey));
		$view->setModel($this->getModel($nameModelForm));
		$view->editForm();
	}
	
	public function editProfile() {
		$this->input->set('layout', 'profile');
		$this->edit();
	}

	public function logout() {
		$this->setRedirectParams(array('task' => 'login.logout'));
	}
}