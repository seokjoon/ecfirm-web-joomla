<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerRegistration extends EcControllerForm {
	
	/**
	 * Method to activate a user.
	 * @return  boolean  True on success, false on failure.
	 * @since   1.6
	 */
	public function activate() {
		$input = JFactory::getApplication()->input;
		$token = $input->getAlnum('token');
		$uParams = JComponentHelper::getParams('com_users');
		$useractivation = $uParams->get('useractivation');
		$user = JFactory::getUser();
		$model = $this->getModel('Registrationform');
		
		// Check for admin activation. Don't allow non-super-admin to delete a super admin
		if (($useractivation != 2) && ($user->get('id'))) {
			$this->setRedirect('index.php');
			return true;
		}
		// If user registration or account activation is disabled, throw a 403.
		if (($useractivation == 0) || ($uParams->get('allowUserRegistration') == 0)) {
			JError::raiseError(403, JText::_('JLIB_APPLICATION_ERROR_ACCESS_FORBIDDEN'));
			return false;
		}
		// Check that the token is in a valid format.
		if ($token === null || strlen($token) !== 32) {
			JError::raiseError(403, JText::_('JINVALID_TOKEN'));
			return false;
		}
		
		// Attempt to activate the user.
		$return = $model->activate($token); //false or user object
		// Check for errors.
		if ($return === false) {
			// Redirect back to the home page.
			$this->setMessage(JText::sprintf
				('COM_ECUSER_REGISTRATION_SAVE_FAILED', $model->getError()), 'warning');
			$this->setRedirect('index.php');
			return false;
		}

		// Redirect to the login screen.
		if ($useractivation == 0) {
			$this->setMessage(JText::_('COM_ECUSER_REGISTRATION_SAVE_SUCCESS'));
			$this->login();
		} elseif ($useractivation == 1) {
			$this->setMessage(JText::_('COM_ECUSER_REGISTRATION_ACTIVATE_SUCCESS'));
			$this->login();
		} elseif ($return->getParam('activate')) {
			$params = array('view' => 'registration', 'layout' => 'complete');
			$params['msg'] = JText::_('COM_ECUSER_REGISTRATION_VERIFY_SUCCESS');
			$this->setRedirectParams($params);
		} else {
			$params = array('view' => 'registration', 'layout' => 'complete');
			$params['msg'] = JText::_('COM_ECUSER_REGISTRATION_ADMINACTIVATE_SUCCESS');
			$this->setRedirectParams($params);
		}
		
		return true;
	}
	
	public function login() {
		$this->setRedirectParams(array('task' => 'login.useForm'));
	}
	
	public function register() {
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		if (JComponentHelper::getParams('com_users')->get('allowUserRegistration') == 0) {
			//$this->setRedirect(JRoute::_('index.php?option=com_users&view=login', false));
			$this->login();
			return false;
		}

		$app = JFactory::getApplication();
		$model = $this->getModel('Registrationform'); //EcDebug::lp($model, true);
		$jform = $this->input->post->get('jform', array(), 'array'); //EcDebug::lp($jform, true);
		$form = $model->getForm(); //EcDebug::lp($form, true);
		if (!$form) { JError::raiseError(500, $model->getError()); return false; }	
		$app->setUserState('com_ecuser.registration.data', $jform);
		
		$return = $model->validate($form, $jform); 
		if($return === false) {
			$errors = $model->getErrors();
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
					continue;
				}
				$app->enqueueMessage($errors[$i], 'warning');
			}
			$this->useForm(); 
			return false;
		}
		if(empty($jform['name'])) $jform['name'] = $jform['username'];
		//unset($jform['password2']);
		
		$return = $model->register($jform); //false or array(user, activate)
		if($return === false) {
			$msg = JText::sprintf
				('COM_USERS_REGISTRATION_SAVE_FAILED', $model->getError());
			$app->enqueueMessage($msg, 'error');
			$this->useForm();
			return false;
		} else {
			$jform['user'] = $return['user']->id;
			$modelUser = $this->getModel('User'); 
			$returnUser = $modelUser->save($jform); //TODO: check
		}

		$app->setUserState('com_ecuser.registration.data', null);
		switch ($return['activate']) {
			case EcuserConst::ACTIVATE_TYPE_ADMIN :
				$this->setMessage(JText::_('COM_ECUSER_REGISTRATION_COMPLETE_VERIFY'));
				$this->login();
				break;
			case EcuserConst::ACTIVATE_TYPE_USER :
				$this->setMessage(JText::_('COM_ECUSER_REGISTRATION_COMPLETE_ACTIVATE'));
				$this->login();
				break;
			default :
				$app->enqueueMessage(JText::_('COM_ECUSER_REGISTRATION_SUCCESS'));
				$this->login();
				break;
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