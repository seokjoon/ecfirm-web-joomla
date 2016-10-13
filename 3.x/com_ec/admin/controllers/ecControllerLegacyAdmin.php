<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcControllerLegacyAdmin extends JControllerLegacy
{

	protected $nameKey;

	protected $option;

	public function __construct($config = array())
	{
		parent::__construct($config);
		
		$this->nameKey = substr($this->getName(), 2);
		$this->option = 'com_' . strtolower($this->getName());
	}

	/**
	 * XX: ec에서는 엔티티명을 키로 사용하나 j backend에서는 'id'를 키로 사용 */
	protected function checkEditId($context, $id)
	{
		if (! ($id))
			return true; //jexit($context.':'.$id.':'.$this->nameKey);
		
		$app = JFactory::getApplication();

		$values = (array) $app->getUserState($context . '.' . $this->nameKey);
		//EcDebug::lp($values); jexit();
		$result = in_array((int) $id, $values['id']);

		return $result;
	}

	public function display($cachable = false, $urlparams = false)
	{
		$defaultView = $this->nameKey . 's';
		$view = $this->input->get('view', $defaultView);
		$this->input->set('view', $view);

		$layout = $this->input->get('layout', '');
		$key = $this->input->getInt($this->nameKey);
		if (($layout == 'edit') && (! ($this->checkEditId($this->option . '.edit', $key)))) {
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $key));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $defaultView, false));
			return false;
		}
		
		parent::display();
		
		return $this;
	}
}