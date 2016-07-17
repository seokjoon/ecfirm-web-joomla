<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewList extends EcViewLegacy {
	protected $items;
	protected $pagination;
	
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->nameKey = substr($this->getName(), 0, -1);
		$this->plural = true;
	}
	
	/**
	 * Execute and display a template script.
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 * @return  mixed  A string if successful, otherwise a Error object. */
	public function display($tpl = null) {
		$this->items = $this->getItems(); //$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');	
		if(count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false; 
		}
		parent::display($tpl);
	}
	
	protected function getItems() {
		$items = $this->get('Items', $this->getName());
		$state = $this->get('State', $this->getName());
		if((isset($state->enabledPlugin)) && ($state->enabledPlugin)) {
			JPluginHelper::importPlugin(EcConst::getPrefix());//('ec');
			$dispatcher = JEventDispatcher::getInstance();
			foreach ($items as $item) $this->eventPlugin($dispatcher, $item); 
		}
		return $items;
	}
}