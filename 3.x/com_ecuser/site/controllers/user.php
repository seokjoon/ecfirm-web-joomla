<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerUser extends EcControllerForm {
	
	protected function allowEdit($data = array(), $nameKey = null) {
		if(empty($data)) $data['user'] = $this->input->get('user', 0, 'uint');
		if($data['user'] == (JFactory::getUser()->id)) return true;
		else return parent::allowEdit($data, $nameKey);
	}
	
	public function delete() {
		$params = array(
			'task' => 'delete.confirm', 
			'nameKey' => $this->nameKey,
			'valueKey' => JFactory::getUser()->id
		);
		$this->setRedirectParams($params);
	}
	
	public function deleteCancel($nameKey = null) {
		$params = array(
			'nameKey' => $this->nameKey,
			'valueKey' => JFactory::getUser()->id
		);
		$this->setRedirectParams($params);
		return true;
	}
	
	public function deleteComplete() {
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$jform = $this->input->post->get('jform', array(), 'array');
		$jform['user'] = JFactory::getUser()->id;
		$this->input->post->set('jform', $jform);
		
		$bool = parent::delete(); //check from model->canDelete()
		if($bool) {
			$msg = JText::_('COM_ECUSER_DELETE_COMPLETE_SUCCESS');
			$this->setRedirect(JUri::base(), $msg); //@FIXME: msg
		} else {
			$msg = JText::_('COM_ECUSER_DELETE_COMPLETE_FAILED');
			$this->setRedirect($this->getRedirectRequest(), $msg);
		}
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