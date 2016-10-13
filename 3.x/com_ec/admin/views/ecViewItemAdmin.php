<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcViewItemAdmin extends EcViewLegacyAdmin
{

	protected $form;

	protected $item;

	public function __construct($config = array())
	{
		parent::__construct($config);
		$this->plural = false;
	}

	public function display($tpl = null)
	{
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->canDo = EcHelperAdmin::getActionsEc($this->getName());

		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors)); /* return false; */
		}
		
		$this->addToolbar();

		parent::display($tpl);
	}

	/** * Add the page title and toolbar.
	 * @since   1.6 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		JToolbarHelper::cancel($this->getName() . '.cancel', 'JTOOLBAR_CLOSE');
		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_CONTENT_ARTICLE_MANAGER_EDIT');
	}
}