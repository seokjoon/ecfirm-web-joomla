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
		$nameView = $this->input->getCmd('view', 'user');
		
		switch ($nameView) {
			case 'login': break;
			case 'registration': break;
			case 'user': //EcDebug::log(__method__);
				$valueUser = $this->input->getCmd('user', $user->id);
				if(($user->guest) && ($valueUser == 0)) $this->setRedirectParams
					(array('view' => 'user', 'task' => 'login.useForm', 'layout' => 'login'));
				else {
					$this->input->set('user', $valueUser);
					$itemId = $this->getItemId();
					if(!empty($itemId)) $this->input->set('Itemid', $itemId);
				}
				break;
		}
		return parent::display($cachable, $urlparams);
	}

	/**
	 * @not use */
	private function getItemId() {
		$itemId = $this->input->getCmd('Itemid');
		return ($itemId) ? null : '&Itemid='.EcUrl::getItemIdCom($this->option);
	}
}