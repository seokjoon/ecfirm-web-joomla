<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewItemForm extends EcViewItem {
	
	public function editForm() {
		$layout = JFactory::getApplication()->input->get('layout', null, 'string');
		$nameModel = (empty($layout)) ? $this->nameKey.'form' : $layout.'form';
		//$this->getModel($nameModel)->setState('joinUser', true);
		$this->form = $this->get('Form', $nameModel);
		parent::display(null);
	}
}