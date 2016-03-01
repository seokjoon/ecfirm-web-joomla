<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewForm extends EcViewItem {
	
	public function editForm() {
		$this->form = $this->get('Form', $this->nameKey.'form');
		parent::display(null);
	}
}