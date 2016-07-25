<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewListAdmin extends EcViewLegacyAdmin {
	protected $items;
	protected $option;
	protected $pagiantion;

	public function __construct($config = array()) {
		parent::__construct($config);
		$this->plural = true;
	}

	public function display($tpl = null) {
		if($this->getLayout() !== 'modal') {
			$this->addToolbar();
			$helper = EcConst::getPrefix().'Helper'.ucfirst(substr($this->getName(), 0, -1));
			$helper::addSubmenu($this->getName());
			$this->sidebar = JHtmlSidebar::render();
		}
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->filterForm = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors)); /* return false; */
		}
		parent::display($tpl);
	}

	/** * Add the page title and toolbar.
	 * @return  void
	 * @since   1.6 */
	protected function addToolbar() {
		$app = JFactory::getApplication();
		$this->option = $app->input->get('option', 'com_'.EcConst::getPrefix());
		$this->canDo = EcHelperAdmin::getActionsEc($this->option);
		JToolbarHelper::title
		(JText::_(JString::strtoupper($this->option)), 'stack article');
		if($this->canDo->get('core.admin')) {
			JToolbarHelper::divider();
			JToolbarHelper::preferences($this->option);
		}
	}
}