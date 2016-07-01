<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
use Joomla\Registry\Registry;



class EcModelForm extends JModelForm {
	protected $context;
	protected $nameCom;
	protected $nameKey;
	
	public function __construct($config = array()) {
		parent::__construct($config = array());
		$this->nameKey = substr($this->name, 0, -4);
		$this->context = $this->option.'.'.$this->nameKey; 
		$optionArray = explode('_', $this->option);
		$this->nameCom = $optionArray[1];
	}

	/**
	 * Abstract method for getting the form from the model.
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 * @return  mixed  A JForm object on success, false on failure
	 * @since 12.2 JModelForm */
	public function getForm($data = array(), $loadData = true)	{ 
		if(!isset($this->context) || empty($this->context))
			$this->context = $this->option.'.'.$this->nameKey;
		$form = $this->loadForm($this->context, $this->nameKey,
			array('control' => 'jform', 'load_data' => $loadData));
		if(empty($form)) return false;
		return $form;
	}
	
	/** Method to get article data.
	 * @param   integer  $itemId  The id of the article.
	 * @return  mixed  Content item data object on success, false on failure.
	 * @since 12.2 JModelAdmin */
	public function getItem($valueKey = 0)	{
		if($valueKey == 0) $valueKey =
			JFactory::getApplication()->input->get($this->nameKey, 0, 'uint');
		if($valueKey == 0) return false;
		$table = $this->getTable();
		$return = $table->load($valueKey);
		if(($return === false) && $table->getError()) {
			$this->setError($table->getError());
			return false; 
		}
		$properties = $table->getProperties(1);
		$item = JArrayHelper::toObject($properties, 'JObject');
		if(property_exists($item, 'options')) {
			$reg = new Registry;
			$reg->loadString($item->options);
			$item->options = $reg->toArray(); 
		} //$this->_item = $item; //XXX
		return $item;	
	}
	
	/**
	 * Method to get a table object, load it if necessary.
	 * @param   string  $name     The table name. Optional.
	 * @param   string  $prefix   The class prefix. Optional.
	 * @param   array   $options  Configuration array for model. Optional.
	 * @return  JTable  A JTable object
	 * @since   12.2 JModelLegacy
	 * @throws  Exception */
	public function getTable($type = null, $prefix = null, $config = array()) {
		if(empty($prefix)) $prefix = $this->nameCom.'Table';
		if(empty($type)) $type = $this->nameKey;
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Method to get the data that should be injected in the form.
	 * @return  array    The default data is an empty array.
	 * @since   12.2 JModelAdmin */
	protected function loadFormData() { //return $this->_item; //XXX
		$data = $this->getItem();
		$this->preprocessData($this->context, $data);
		return $data;
	}
	
	/**
	 * Method to allow derived classes to preprocess the data.
	 * @param   string  $context  The context identifier.
	 * @param   mixed   &$data    The data to be processed. It gets altered directly.
	 * @return  void
	 * @since   3.1 JModelForm */
	protected function preprocessData($context, &$data) {
		if(!($this->getState('enabledPlugin', false))) return;
		$dispatcher = JEventDispatcher::getInstance();
		JPluginHelper::importPlugin(EcConst::getPrefix());//('ec');
		$results = $dispatcher->trigger
			('on'.$this->nameKey.'PrepareData', array($context, $data));
		if (count($results) > 0 && in_array(false, $results, true))
			$this->setError($dispatcher->getError());
	}
	
	/**
	 * Method to allow derived classes to preprocess the form.
	 * @param   JForm   $form   A JForm object.
	 * @param   mixed   $data   The data expected for the form.
	 * @param   string  $group  The name of the plugin group to import (defaults to "content").
	 * @return  void
	 * @see     JFormField
	 * @since   12.2 JModelForm
	 * @throws  Exception if there is an error in the form event. */
	protected function preprocessForm(JForm $form, $data, $group = '') {
		if(!($this->getState('enabledPlugin', false))) return;
		if(empty($group)) $group = EcConst::getPrefix();//'ec';
		JPluginHelper::importPlugin($group);
		$dispatcher = JEventDispatcher::getInstance();
		$results = $dispatcher->trigger
			('on'.$this->nameKey.'PrepareForm', array($form, $data));
		if (count($results) && in_array(false, $results, true)) {
			$error = $dispatcher->getError();
			if (!($error instanceof Exception)) throw new Exception($error); 
		}
	}
}