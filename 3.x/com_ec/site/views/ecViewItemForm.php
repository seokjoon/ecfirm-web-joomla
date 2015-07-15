<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewItemForm extends EcViewItem {
	
	/**
	 * Execute and display a template script.
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 * @return  mixed  A string if successful, otherwise a Error object. */
	public function display($tpl = null) {
		if(JFactory::getApplication()->input->get('layout', null, 'string') == 'edit') 
			$this->form = $this->get('Form', $this->nameKey.'form');
		//EcDebug::lp($this->get('Item', $this->nameKey));
		//EcDebug::lp($this->form);
		parent::display($tpl);
	}
}