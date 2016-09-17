<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserTableUserObserver extends EcTableObserver {
	private $imgsLoad;
	private $typeAliasPattern;
	
	public static function createObserver
		(JObservableInterface $observableObject, $parmas = array()) {
		$observer = new self($observableObject);
		$observer->typeAliasPattern = $parmas['typeAlias'];
		return $observer;
	}
	
	private function deleteFile($name = 'files') {
		if(property_exists($this->table, $name)) {
			$reg = new Registry;
			$reg->loadString($this->table->$name);
			if(count($reg) > 0) EcFile::delete($reg->toArray());
		}
	}
	
	private function loadFile($name = 'files') {
		$nameLoad = $name.'Load';
		if(property_exists($this->table, $name))
			$this->$nameLoad = $this->table->$name;
	}
	
	public function onAfterLoad(&$result, $row) {
		$this->loadFile('imgs');
	}
	
	public function onAfterStore(&$result) { }
	
	public function onBeforeDelete($pk) {
		$this->deleteFile('imgs');
	}
	
	public function onBeforeLoad($keys, $reset) { }
	
	public function onBeforeStore($updateNulls, $tableKey) {
		if(JFactory::getApplication()->isSite()) $this->table->modified = date('Y-m-d H:i:s');
		if(empty($this->table->user)) $this->table->created = $this->table->modified;
		$this->updateFile('imgs');
	}
	
	private function updateFile($name = 'files') {
		$nameLoad = $name.'Load';
		if((!empty($this->table->$name)) && ($this->$nameLoad != $this->table->$name)) { //EcDebug::lp($this->$nameLoad);; EcDebug::lp($this->table->$name, true);
			$reg = new JRegistry;
			if(!empty($this->$nameLoad)) $reg->loadString($this->$nameLoad);
			$this->table->$name = (empty($this->table->$name)) 
				? array() : json_decode($this->table->$name, true);
			foreach ($this->table->$name as $fileName => $fileValue)
				if(!empty($fileValue)) {
					EcFile::delete(array($reg->get($fileName))); //EcDebug::lp(array($reg->get($fileName)), true);
					$reg->set($fileName, $fileValue); //EcDebug::lp($reg, true);
			}
			$this->table->$name = stripslashes($reg->toString());
		}
		$this->$nameLoad = null;
	}
}