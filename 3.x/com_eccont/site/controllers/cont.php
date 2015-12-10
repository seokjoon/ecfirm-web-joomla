<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EccontControllerCont extends EcControllerForm {

	public function save($nameKey = null, $urlVar = null) {
		$this->saveFileImg(); //EcDebug::log($this->input->post->get('jform', array(), 'array')); //jexit();
		parent::save($nameKey, $urlVar);
	}
}