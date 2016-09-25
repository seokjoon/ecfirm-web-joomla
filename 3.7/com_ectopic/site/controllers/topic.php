<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicControllerTopic extends EcControllerForm {
	
	public function save($nameKey = null, $urlVar = null) {
		$this->saveFile();
		$this->saveFileImg(); //EcDebug::log($this->input->post->get('jform', array(), 'array'), true);
		parent::save($nameKey, $urlVar);
	}
}