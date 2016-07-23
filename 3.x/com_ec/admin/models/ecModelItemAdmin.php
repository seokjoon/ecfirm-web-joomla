<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcModelItemAdmin extends JModelAdmin	{

	/**
	 * @param array $pks
	 * @param int $value
	 * @param string $attr
	 * @return boolean */
	public function bool($pks, $value=0, $attr='display')	{
		$pks = (array)$pks;
		JArrayHelper::toInteger($pks);
		if(empty($pks))	{
			$this->setError(JText::_('COM_BM_NO_ITEM_SELECTED'));
			return false;
		} //EcDebug::log($pks, __method__); //EcDebug::log($value.':'.$attr, __method__);
		$table = $this->getTable(); //EcDebug::log($table, __method__);
		$user = JFactory::getUser();
		foreach ($pks as $pk)	{
			if (!$user->authorise('core.edit',
				'com_'.EcConst::getPrefix().$this->name.'.'.$this->name.'.'.$pk)) {
				$this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_CANNOT_EDIT'));
				return false;
			}
			if(!$table->load($pk))	{
				if ($error = $table->getError()) { // Fatal error
					$this->setError($error);
					return false;
				} else { // Not fatal error
					$this->setError(JText::sprintf
					('JLIB_APPLICATION_ERROR_BATCH_MOVE_ROW_NOT_FOUND', $pk));
					continue;
				}
			}
			$table->$attr = $value;
			if(!$table->check())	{ //Check the row
				$this->setError($table->getError());
				return false;
			}
			if(!$table->store())	{ //Store the row
				$this->setError($table->getError());
				return false;
			}
		}
		$this->cleanCache();
		return true;
	}

	/** * Method to get the record form.
	 * @param   array      $data        Data for the form.
	 * @param   boolean    $loadData    True if the form is to load its own data
	 * (default case), false if not.
	 * @return  mixed  A JForm object on success, false on failure
	 * @since   1.6 */
	public function getForm($data = array(), $loadData = true) {
		if(!isset($this->context) || empty($this->context))
			$this->context = $this->option.'.'.$this->name;
		$form = $this->loadForm($this->context, $this->name,
			array('control' => 'jform', 'load_data' => $loadData));
		if(empty($form)) return false;
		return $form;
	}

	/** * Returns a Table object, always creating it.
	 * @param   type      The table type to instantiate
	 * @param   string    A prefix for the table class name. Optional.
	 * @param   array     Configuration array for model. Optional.
	 * @return  JTable    A database object */
	public function getTable($type = null, $prefix = null, $config = array()) {
		if(empty($prefix)) $prefix = EcConst::getPrefix().$this->name.'Table';
		if(empty($type)) $type = $this->name; //EcDebug::lp($prefix.':'.$type);
		return JTable::getInstance($type, $prefix, $config);
	}

	/** * Method to get the data that should be injected in the form.
	 * @return  array    The default data is an empty array.
	 * @since   12.2 */
	protected function loadFormData() { //return array();
		return $this->getItem();
	}
}