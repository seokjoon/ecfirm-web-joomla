<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerRegistration extends EcControllerForm {
	
	public function activate() {
		//$this->input->set('layout', 'activate');
		//TODO
		
		
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
				('COM_USERS_REGISTRATION_SAVE_FAILED', $modelUser->getError());
			$app->enqueueMessage($msg, 'error');
			$this->useForm();
			return false;
		} else {
			$jform['user'] = $return['user']->id;
			$modelUser = $this->getModel('User'); 
			//$returnUser = $modelUser->saveEcuser($jform);	
			$returnUser = $modelUser->save($jform);
		}

		$app->setUserState('com_ecuser.registration.data', null);
		
		if($return['activate'] === 'useractivate') {
			$params = array('task' => 'registration.useForm', 'layout' => 'complete');
			$params['msg'] = JText::_('COM_ECUSER_REGISTRATION_COMPLETE_ACTIVATE');
			$this->setRedirectParams($params);
		} else {
			$app->enqueueMessage(JText::_('COM_ECUSER_REGISTRATION_SUCCESS'));
			$this->login();
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