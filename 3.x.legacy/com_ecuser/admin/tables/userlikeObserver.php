<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserTableUserlikeObserver extends JTableObserver {
	protected $typeAliasPattern;
	protected $valueCol;
	
	public static function createObserver
		(JObservableInterface $observableObject, $parmas = array()) {
		$observer = new self($observableObject);
		$observer->typeAliasPattern = $parmas['typeAlias'];
		return $observer;
	}
	
	/**
	 * Post-processor for $table->delete($pk)
	 * @param   mixed  $pk  The deleted primary key value.
	 * @return  void
	 * @since   3.1.2 */
	public function onAfterDelete($pk) { 
		EcDml::updateColumnCount('ecuser', 'user', $this->table->user, 'userlike', -1);
	}
	
	/**
	 * Post-processor for $table->load($keys, $reset)
	 * @param   boolean  &$result  The result of the load
	 * @param   array    $row      The loaded (and already binded to $this->table) row of the database table
	 * @return  void
	 * @since   3.1.2 */
	public function onAfterLoad(&$result, $row) {
		$this->valueCol = $this->table->user;
	}
	
	/**
	 * Post-processor for $table->store($updateNulls)
	 * @param   boolean  &$result  The result of the store
	 * @return  void
	 * @since   3.1.2 */
	public function onAfterStore(&$result) { 
		if($this->valueCol != $this->table->user) 
			EcDml::updateColumnCount('ecuser', 'user', $this->table->user, 'userlike', 1);
	}
}