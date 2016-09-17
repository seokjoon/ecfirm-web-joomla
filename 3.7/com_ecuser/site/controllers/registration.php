<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerRegistration extends EcControllerForm {
	
	public function activate() {
		$this->input->set('layout', 'activate');
		//TODO
	}
	
	public function login() {
		$this->setRedirectParams(array('task' => 'login.useForm'));
	}
	
	public function register() {
		$app = JFactory::getApplication();
		JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
		$jform = $this->input->post->get('jform', array(), 'array'); //EcDebug::lp($jform, true);
		$model = $this->getModel('Registrationform'); //EcDebug::lp($model, true);
		$form = $model->getForm(); //EcDebug::lp($form, true);
		if (!$form) { JError::raiseError(500, $model->getError()); return false; }	
		$return = $model->validate($form, $jform);
		if($return === false) {
			$errors = $model->getErrors();
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'error');
					continue;
				}
				$app->enqueueMessage($errors[$i], 'error');
			}
			$this->useForm(); 
			return false;
		}
		$modelUser = $this->getModel('User'); 
		$return = $modelUser->save($jform);
		if($return === false) {
			$msg = JText::sprintf('COM_USERS_REGISTRATION_SAVE_FAILED', $modelUser->getError());
			$app->enqueueMessage($msg, 'error');
			$this->useForm();
		}
		return true;
	}
	
	public function remind() {
		$this->setRedirectParams(array('task' => 'remind.useForm'));
	}
	
	public function reset() {
		$this->setRedirectParams(array('task' => 'reset.useForm'));
	}
}