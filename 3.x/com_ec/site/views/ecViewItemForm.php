<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewItemForm extends EcViewItem {
	
	public function editForm() {
		$this->form = $this->get('Form', $this->nameKey.'form');
		parent::display(null);
	}
}