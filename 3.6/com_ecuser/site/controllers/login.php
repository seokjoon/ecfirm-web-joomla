<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerLogin extends EcControllerForm {
	
	public function login() {
		JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
		$app = JFactory::getApplication();
		$input = $app->input; //EcDebug::lp($input);
		$method = $this->input->getMethod();
		/* $jform = $this->input->$method->get('jform', array(), 'array');
		$this->input->$method->set('username', $jform['username']);
		$this->input->$method->set('password', $jform['password']);
		$data['username'] = $input->$method->get('username', '', 'USERNAME');
		$data['password'] = $input->$method->get('password', '', 'RAW'); //EcDebug::lp($data); */
		$data = $this->input->$method->get('jform', array(), 'array'); //EcDebug::lp($data, true);
		if(true !== $app->login($data, array()))	
			$this->setRedirectParams(array('task' => 'login.useForm'));
		else $this->setRedirectParams(array('view' => 'user', 'layout' => 'default', 
			'etc' => 'user='.JFactory::getUser()->id.'&Itemid='.EcUrl::getItemId()));
	}
	
	public function logout() {
		//JSession::checkToken('request') or jexit(JText::_('JINVALID_TOKEN'));
		$app = JFactory::getApplication();
		$error  = $app->logout(); 
		if ($error instanceof Exception) $this->setRedirect($this->getRedirectRequest()); //@attention
		else $this->setRedirectParams(array('task' => 'login.useForm'));
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