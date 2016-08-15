<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicControllerTopiccmt extends EcControllerForm {
	
	public function delete() {
		//$jform = $this->input->post->get('jform', array(), 'array'); EcDebug::lp($jform, true, __method__);
		$bool = parent::delete(); 
		$this->setRedirect($this->getRedirectRequest());
		return $bool;
	}
	
	public function save($nameKey = null, $urlVar = null) {
		//$jform = $this->input->post->get('jform', array(), 'array'); EcDebug::lp($jform, true, __method__);
		$bool = parent::save($nameKey, $urlVar);
		$this->setRedirect($this->getRedirectRequest());
		return $bool;
	}
}