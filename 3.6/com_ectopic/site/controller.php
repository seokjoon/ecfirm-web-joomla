<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicController extends EcControllerLegacy {
	
	public function display($cachable = false, $urlparams = array()) {
		
		if($this->input->get('view') == 'topics') {
			$view = $this->getView('topics', JFactory::getDocument()->getType());
			$view->setModel($this->getModel('topiccat'));
		}
		return parent::display($cachable, $urlparams);
	}
}