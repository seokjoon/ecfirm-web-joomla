<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicTableTopiccmtObserver extends EcTableObserver {
	private $valueCol;
	
	/**
	 * Post-processor for $table->delete($pk)
	 * @param   mixed  $pk  The deleted primary key value.
	 * @return  void
	 * @since   3.1.2 */
	public function onAfterDelete($pk) {
		$nameKey = $this->getKeyName();	
		EcDml::updateColumnCount($nameKey, 'topic', $this->table->topic, $nameKey, -1);
	}

	/**
	 * Post-processor for $table->load($keys, $reset)
	 * @param   boolean  &$result  The result of the load
	 * @param   array    $row      The loaded (and already binded to $this->table) row of the database table
	 * @return  void
	 * @since   3.1.2 */
	public function onAfterLoad(&$result, $row) {
		$this->valueCol = $this->table->topic;
	}
	
	/**
	 * Post-processor for $table->store($updateNulls)
	 * @param   boolean  &$result  The result of the store
	 * @return  void
	 * @since   3.1.2 */
	public function onAfterStore(&$result) {
		$nameKey = $this->getKeyName(); EcDebug::log($nameKey);
		if($this->valueCol != $this->table->topic)
			EcDml::updateColumnCount($nameKey, 'topic', $this->table->topic, $nameKey, 1);
	}
}