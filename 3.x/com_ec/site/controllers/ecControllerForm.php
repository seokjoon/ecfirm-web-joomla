<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcControllerForm extends EcControllerLegacy {
	
	public function __construct($config = array()) {
		parent::__construct($config);
		if(!isset($config['default_view'])) $this->default_view = $this->entity;
	}
	
	/**
	 * Method to add a new record.
	 * @return  mixed  True if the record can be added, a error object if not.
	 * @since   12.2 JControllerForm */
	public function add() {
		if(parent::add()) $params['etc'] = $this->getRedirectToItemAppend();
		else $params['etc'] = $this->getRedirectToListAppend();
		$this->setRedirectParams($params);
	}
	
	/**
	 * Method to cancel an edit.
	 * @param   string  $nameKey  The name of the primary key of the URL variable.
	 * @return  boolean  True if access level checks pass, false otherwise.
	 * @since   12.2 JControllerForm */
	public function cancel($nameKey = null) {
		if(parent::cancel()) $this->setRedirectParams();
	}
	
	/** * Removes an item.
	 * @return  boolean
	 * @since   12.2 JControllerAdmin */
	public function delete() {
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN')); //XXX
		$params['msg'] = (parent::delete()) ?  
			JText::_('COM_'.$this->name.'_'.$this->nameKey.'_DELETE_SUCCESS') :
			JText::_('COM_'.$this->name.'_'.$this->nameKey.'_DELETE_FAILURE');
		$this->setRedirectParams($params);
	}
	
	/**
	 * Method to edit an existing record.
	 * @param   string  $nameKey     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key
	 * (sometimes required to avoid router collisions).
	 * @return  boolean  True if access level check and checkout passes, false otherwise.
	 * @since   12.2 JControllerForm */
	public function edit($nameKey = null, $urlVar = null) {
		if(empty($nameKey)) $nameKey = $this->nameKey;
		$valueKey = $this->input->get($nameKey, 0, 'uint');
		if(parent::edit($nameKey, $urlVar))
			$params['etc'] = $this->setRedirectToItemAppend($valueKey, $nameKey);
		else $params['etc'] = $this->setRedirectToListAppend();
		$this->setRedirectParams($params);
	}

	/**
	 * Gets the URL arguments to append to an item redirect.
	 * @param   integer  $valueKey  The primary key id for the item.
	 * @param   string   $nameKey    The name of the URL variable for the id.
	 * @return  string  The arguments to append to the redirect URL.
	 * @since   12.2 JControllerForm */
	protected function getRedirectToItemAppend($valueKey = 0, $nameKey = null) {
		if(empty($urlVar))
		$tmpl   = $this->input->get('tmpl');
		$layout = $this->input->get('layout', 'edit', 'string');
		$append = '';
		if($tmpl) $append .= '&tmpl='.$tmpl; 
		if($layout) $append .= '&layout='.$layout; 
		if(!($valueKey > 0)) $append .= '&'.$nameKey.'='.$valueKey; 
		return $append;
	}
	
	/**
	 * Gets the URL arguments to append to a list redirect.
	 * @return  string  The arguments to append to the redirect URL.
	 * @since   12.2 JControllerForm */
	protected function getRedirectToListAppend() {
		$tmpl = JFactory::getApplication()->input->get('tmpl');
		$append = '';
		if ($tmpl) $append .= '&tmpl=' . $tmpl;
		return $append;
	}
	
	/**
	 * Method to save a record.
	 * @param   string  $nameKey     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 * @return  boolean  True if successful, false otherwise.
	 * @since   12.2 JControllerForm */
	public function save($nameKey = null, $urlVar = null) {
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$result = parent::save($nameKey, $urlVar);
		$params['msg'] = 
			JText::_('COM_'.$this->name.'_'.$this->nameKey.'_SAVE_SUCCESS');
		if($result) $this->setRedirectParams($params);
	}
}