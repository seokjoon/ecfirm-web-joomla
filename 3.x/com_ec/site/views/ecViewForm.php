<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewForm extends EcViewItem {
	
	public function editForm() {
		$layout = JFactory::getApplication()->input->get('layout', null, 'string');
		$nameModelForm = (empty($layout)) ? $this->nameKey.'form' : $layout.'form';
		$this->form = $this->get('Form', $nameModelForm);
		parent::display(null);
	}

	/**
	 * @DELETE ME */
	public function editFormLegacy() {
		$this->form = $this->get('Form', $this->nameKey.'form');
		parent::display(null);
	}
	
	public function useForm($layout = null) {
		if(empty($layout)) $layout = JFactory::getApplication()->input->get('layout', null, 'string').'form';//FIXME
		if(empty($layout)) $layout = $this->nameKey.'form'; //jexit($layout);
		$this->form = $this->get('Form', $layout); //EcDebug::lp($this->form); //jexit();
		parent::display(null);
	}
}