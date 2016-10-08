<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerLogin extends EcControllerForm {
	
	public function login() {
		JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
		$app = JFactory::getApplication();
		$method = $this->input->getMethod();
		$data = $this->input->$method->get('jform', array(), 'array'); //EcDebug::lp($data, true);
		if(empty($data)) {
			$data['username'] = $this->input->$method->get('username', null, 'USERNAME');
			$data['password'] = $this->input->$method->get('password', null, 'RAW');
			$data['return'] = base64_decode($this->input->post->get('return', null, 'BASE64'));
		} 
		
		//TODO: remember me
		
		if(true !== $app->login($data, array()))	
			$this->setRedirectParams(array('task' => 'login.useForm'));
		else if((empty($data['return'])) || (!(JUri::isInternal($data['return']))))
			$this->setRedirectParams(array('view' => 'user', 'layout' => 'default', 
				'etc' => 'user='.JFactory::getUser()->id));
		else $app->redirect(JRoute::_($data['return']));
	}
	
	public function logout() {
		//JSession::checkToken('request') or jexit(JText::_('JINVALID_TOKEN'));
		$app = JFactory::getApplication();
		$data['return'] = base64_decode($this->input->post->get('return', null, 'BASE64'));
		$error  = $app->logout(); 
		if ($error instanceof Exception) $this->setRedirect($this->getRedirectRequest()); //@attention
		else if((empty($data['return'])) || (!(JUri::isInternal($data['return']))))
			$this->setRedirectParams(array('task' => 'login.useForm'));
		else $app->redirect(JRoute::_($data['return']));
	}
	
	public function remind() {
		$this->setRedirectParams(array('task' => 'remind.useForm'));	
	}
	
	public function registration() {
		$this->setRedirectParams(array('task' => 'registration.useForm'));	
	}
	
	public function reset() {
		$this->setRedirectParams(array('task' => 'reset.useForm'));	
	}
}