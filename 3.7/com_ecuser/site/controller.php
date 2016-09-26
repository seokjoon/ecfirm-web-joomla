<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserController extends EcControllerLegacy {
	
	/**
	 * Method to display a view.
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   boolean  $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 * @return  JController  This object to support chaining. */
	public function display($cachable = false, $urlparams = false) {
		$user = JFactory::getUser();
		$nameView = $this->input->getCmd('view', 'login');
		
		switch ($nameView) {
			case 'login':
				if($user->guest) $this->setRedirectParams
					(array('view' => 'user', 'task' => 'login.useForm', 'layout' => 'login'));
				else $this->displayUser($user->id);
				break;
			case 'registration':
				if($user->guest) $this->setRedirectParams
					(array('view' => 'user', 'task' => 'registration.useForm', 'layout' => 'registration'));
				else $this->displayUser($user->id);
				break;
			case 'user': //EcDebug::log(__method__);
				$valueUser = $this->input->getCmd('user', $user->id);
				if(($user->guest) && ($valueUser == 0)) $this->setRedirectParams
					(array('view' => 'user', 'task' => 'login.useForm', 'layout' => 'login'));
				else $this->displayUser($valueUser);
				break;
		}
		return parent::display($cachable, $urlparams);
	}
	
	private function displayUser($id) { //EcDebug::log(__method__);
		//$this->setRedirectParams(array('view' => 'user', 'layout' => 'dafault', 'etc' => 'user='.$id));
		//$this->setRedirectParams(array('view' => 'user', 'task' => 'user.display', 'etc' => 'user='.$id));
		$itemId = $this->input->getCmd('Itemid');
		$itemId = ($itemId) ? null : '&Itemid='.EcUrl::getItemIdCom($this->option);
		$this->setRedirectParams
			(array('view' => 'user', 'task' => 'user.display', 'etc' => 'user='.$id.$itemId));
		$this->redirect();
	}
}