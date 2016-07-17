<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewForm extends EcViewItem {
	
	/**
	 * @deprecated: use form() */
	public function editForm() {
		$this->form = $this->get('Form', $this->nameKey.'Form');
		parent::display(null);
	}
	
	public function useForm($layout = null) {
		if(empty($layout)) $layout = JFactory::getApplication()->input->get('layout', null, 'string').'Form';//FIXME
		if(empty($layout)) $layout = $this->nameKey.'Form'; //jexit($layout);
		$this->form = $this->get('Form', $layout); //EcDebug::lp($this->form); //jexit();
		parent::display(null);
	}
}