<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
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
		if(parent::add()) {
			$this->turnbackPush('edit');
			$layout = $this->input->get('layout', null, 'string');
			if(!(empty($layout))) $params['layout'] = $layout;
			$params['view'] = $this->nameKey;
			$params['task'] = $this->nameKey.'.editForm'; 
		}
		$this->setRedirectParams($params);
	}
	
	/**
	 * Method to cancel an edit.
	 * @param   string  $nameKey  The name of the primary key of the URL variable.
	 * @return  boolean  True if access level checks pass, false otherwise.
	 * @since   12.2 JControllerForm */
	public function cancel($nameKey = null) {
		if(parent::cancel()) $this->turnbackPop('edit'); 
	}
	
	/** * Removes an item.
	 * @return  boolean
	 * @since   12.2 JControllerAdmin */
	public function delete() {
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN')); //XXX
		if(parent::delete()) {
			$params['view'] = $this->nameKey.'s';
			$params['msg'] = JText::_($this->option.'_'.$this->nameKey.'_DELETE_SUCCESS'); 
			$this->setRedirectParams($params); 
		} else {
			$this->setMessage(JText::_($this->option.'_'.$this->nameKey.'_DELETE_FAILURE'));
			$this->turnbackPush();
			$this->turnbackPop(); 
		}
	}

	/* DO NOT USE
	protected function deleteFileImg() {
		$valueKey = $this->input->get($this->nameKey, 0, 'uint');
		if($valueKey == 0) return false;
		$item = $this->getModel()->getItem($valueKey);
		$imgs = json_decode($item->imgs, true); //EcDebug::log($imgs);
		if((is_array($imgs)) && (isset($imgs['img']))) EcFile::delete($imgs);
	} */
	
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
		if(parent::edit($nameKey, $urlVar)) {
			$this->turnbackPush('edit');
			$params['nameKey'] = $nameKey;
			$params['valueKey'] = $valueKey;
			$params['view'] = $nameKey;
			$params['task'] = $nameKey.'.editForm'; //EcDebug::log($params, __method__);
			$this->setRedirectParams($params); 
		}
	}
	
	public function editForm() {
		//TODO internal redirect check
		$view = $this->getView($this->default_view, 
			JFactory::getDocument()->getType(), '', array('layout' => 'edit'));
		$view->setModel($this->getModel($this->nameKey));
		$view->setModel($this->getModel($this->nameKey.'form'));
		$view->editForm();
	}

	/**
	 * Method to save a record.
	 * @param   string  $nameKey     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 * @return  boolean  True if successful, false otherwise.
	 * @since   12.2 JControllerForm */
	public function save($nameKey = null, $urlVar = null) {
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		if(parent::save($nameKey, $urlVar)) 
			$params['msg'] = JText::_($this->option.'_'.$this->nameKey.'_SAVE_SUCCESS'); 
		else $this->setMessage(JText::_($this->option.'_'.$this->nameKey.'_SAVE_FAILURE'));
		$this->turnbackPop('edit'); 
	}
	
	protected function saveFileImg() {
		$files = $this->input->files->get('jform'); //EcDebug::lp($files); jexit();
		if($files['img']['error'] != 0) return false;
		//$this->deleteFileImg(); //DO NOT USE
		$jform = $this->input->post->get('jform', array(), 'array');
		//$imgs = EcFileImg::setFileImgShop($jform, $files['img'], $this->nameKey);
		$imgs = EcFileImg::setFileImgByUser($files['img'], $this->nameKey);
		$jform['imgs'] = json_encode($imgs, JSON_UNESCAPED_SLASHES);
		$this->input->post->set('jform', $jform);
	}
	
	protected function turnbackPop($task = null) { //EcDebug::log($task, __function__);
		if(empty($task)) $task = $this->task;
		$turnback = $this->getUserState($task, 'turnback', null);
		$this->setUserState($task, 'turnback', null);
		if(!(empty($turnback))) $this->setRedirect($turnback);
	}
	
	protected function turnbackPush($task = null) { //EcDebug::log($task, __function__);
		if(empty($task)) $task = $this->task;
		$this->setUserState($task, 'turnback', JUri::getInstance()->toString());
	}
}