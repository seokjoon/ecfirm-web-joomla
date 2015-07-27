<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerUser extends EcControllerForm {
	
	public function __construct($config = array()) {
		parent::__construct($config);
	}
	
	public function editAccount() {
		$this->input->set('layout', 'account');
		$this->edit();
	}
	
	public function editAddress() {
		$this->input->set('layout', 'address');
		$this->edit();
	}
	
	public function editForm() {
		//TODO internal redirect check
		$layout = $this->input->get('layout', null, 'string');
		$nameModelForm = (empty($layout)) ? $this->nameKey.'form' : $layout.'form';
		$layout = (empty($layout)) ? 'edit' : 'edit_'.$layout; //EcDebug::log($layout, __method__);
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
}