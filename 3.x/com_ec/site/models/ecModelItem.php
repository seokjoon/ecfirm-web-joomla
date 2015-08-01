<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
use Joomla\Registry\Registry;



class EcModelItem extends JModelItem {
	protected $context;
	protected $nameCom;
	
	public function __construct($config = array()) {
		parent::__construct($config = array());
		$this->context = $this->option.'.'.$this->name;
		$optionArray = explode('_', $this->option);
		$this->nameCom = $optionArray[1]; 
	}
	
	/**
	 * Method to test whether a record can be deleted.
	 * @param   object  $record  A record object.
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission for the component.
	 * @since   12.2 JModelAdmin */
	protected function canDelete($record) {
		$user = JFactory::getUser();
		//return $user->authorise('core.delete', $this->option);
		$nameKey = $this->name;
		return $user->authorise('core.delete', $this->context.'.'.(int)$record->$nameKey);
	}
	
	/**
	 * Method to delete one or more records.
	 * @param   array  &$valueKeys  An array of record primary keys.
	 * @return  boolean  True if successful, false if an error occurs.
	 * @since   12.2 JModelAdmin */
	public function delete(&$valueKeys) {
		if($this->getState('enabledPlugin', false)) {
			$dispatcher = JEventDispatcher::getInstance();
			JPluginHelper::importPlugin('ec'); }
		$valueKeys = (array)$valueKeys;
		$table = $this->getTable();
		foreach ($valueKeys as $i => $valueKey) {
			if(!($table->load($valueKey))) {
				$this->setError($table->getError());
				return false; }
			if(!($this->canDelete($table))) {
				unset($valueKeys[$i]);
				if($this->getError()) $this->setError('canDelete false');
				else $this->setError
					(JText::_('JLIB_APPLICATION_ERROR_DELETE_NOT_PERMITTED'));
				return false; }
			if($this->getState('enabledPlugin', false)) {
				$result = $dispatcher->trigger
					('on'.ucfirst($this->name).'BeforeDelete', array($this->context, $table));
				if(in_array(false, $result, $true)) {
					$this->setError($table->getError());
					return false; } }
			if(!($table->delete($valueKey))) {
				$this->setError($table->getError());
				return false; }
			if($this->getState('enabledPlugin', false)) $dispatcher->trigger
				('on'.ucfirst($this->name).'AfterDelete', array($this->context, $table)); }
		$this->cleanCache();
		return true;
	}
	
	/** Method to get article data.
	 * @param   integer  $itemId  The id of the article.
	 * @return  mixed  Content item data object on success, false on failure.
	 * @since 12.2 JModelAdmin */
	public function getItem($valueKey = 0)	{
		if($valueKey == 0) $valueKey = $this->getState($this->name, 0);
		if($valueKey == 0) $valueKey = 
			JFactory::getApplication()->input->get($this->name, 0, 'uint');
		if($valueKey == 0) return false;
		$table = $this->getTable();
		$return = $table->load($valueKey);
		if(($return === false) && $table->getError()) {
			$this->setError($table->getError());
			return false; }
		$properties = $table->getProperties(1);
		$item = JArrayHelper::toObject($properties, 'JObject');
		if(property_exists($item, 'option')) {
			$reg = new Registry;
			$reg->loadString($item->option);
			$item->option = $reg->toArray(); }	
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
		if(empty($type)) $type = $this->name;
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Method to save the form data.
	 * @param   array  $data  The form data.
	 * @return  boolean  True on success, False on error.
	 * @since   12.2 JModelAdmin */	
	public function save($data) { //EcDebug::log($data, __method__);
		if((isset($data['option'])) && (is_array($data['option']))) {
			$reg = new Registry;
			$reg->loadArray($data['option']);
			$data['option'] = (string)$reg; }
		if($this->getState('enabledPlugin', false)) {
			$dispatcher = JEventDispatcher::getInstance();
			JPluginHelper::importPlugin('ec'); }
		$table = $this->getTable();
		$nameKey = $table->getKeyName();
		$valueKey = (!empty($data[$nameKey])) ? $data[$nameKey] : 0;
		$isNew = true;
		try {
			if($valueKey > 0) {
				$table->load($valueKey);
				$isNew = false; } 
			if(!($table->bind($data))) {
				$this->setError($table->getError());
				return false; }
			//$this->prepareTable($table);
			if(!($table->check())) {
				$this->setError($table->getError());
				return false; }
			if($this->getState('enabledPlugin', false)) {
				$resule = $dispatcher->trigger
					('on'.$this->name.'BeforeSave', array($this->context, $table, $isNew));
				if(in_array(false, $resule, true)) {
					$this->setError($table->getError());
					return false; } }
			if(!($table->store())) {
				$this->setError($table->getError());
				return false; }
			$this->cleanCache();
			if($this->getState('enabledPlugin', false)) $dispatcher->trigger
				('on'.$this->name.'AfterSave', array($this->context, $table, $isNew)); }
		catch(Exception $e) {
			$this->setError($e->getMessage());
			return false; }
		return true;
	}
}