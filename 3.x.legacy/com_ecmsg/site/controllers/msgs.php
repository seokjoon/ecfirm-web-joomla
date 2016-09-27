<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgControllerMsgs extends EcControllerAjax {
	
	public function display($cachable = false, $urlparams = array()) {
		$modelForm = $this->getModel($this->nameKey.'form');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($modelForm);
		parent::display($cachable, $urlparams);
	}
}