<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



abstract class EcViewLegacy extends JViewLegacy {
	protected $state;
	protected $canDo;//@var JObject Object containing permissions for the item
	
	public function display($tpl = null) {
		$this->state = $this->get('State');
		if (count($errors = $this->get('Errors'))) 
			JError::raiseError(500, implode("\n", $errors)); /* return false; */ 
		parent::display($tpl);
	}
}