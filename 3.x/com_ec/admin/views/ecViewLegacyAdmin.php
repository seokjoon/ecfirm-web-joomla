<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */

use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die('Restricted access');

abstract class EcViewLegacyAdmin extends HtmlView //JViewLegacy
{

	protected $canDo; //JObject Object containing permissions for the item
	protected $plural;

	protected $state;

	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors)); /* return false; */
		}

		parent::display($tpl);
	}
}