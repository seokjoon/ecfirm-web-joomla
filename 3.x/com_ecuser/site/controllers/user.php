<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserControllerUser extends EcControllerForm {
	
	public function __construct($config = array()) {
		parent::__construct($config);
	}
	
	public function editAddress() {
		$this->input->set('layout', 'address');
		$this->edit();
	}
	
	public function editProfile() {
		$this->input->set('layout', 'profile');
		$this->edit();
	}
}