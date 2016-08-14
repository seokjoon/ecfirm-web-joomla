<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicController extends EcControllerLegacy {
	
	public function display($cachable = false, $urlparams = array()) {
		
		$nameView = $this->input->get('view');
		switch ($nameView) {
			case 'topic' :
				$view = $this->getView('topic', JFactory::getDocument()->getType());
				//$view->setModel($this->getModel('topiccmt'));
				$view->setModel($this->getModel('topiccmtform'));
				$view->setModel($this->getModel('topiccmts'));
				break;
			case 'topics' : 
				$view = $this->getView('topics', JFactory::getDocument()->getType());
				$view->setModel($this->getModel('topiccat'));
				break;
		}
		
		return parent::display($cachable, $urlparams);
	}
}