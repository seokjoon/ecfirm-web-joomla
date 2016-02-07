<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
use Joomla\Registry\Registry;



class EcTableObserver extends JTableObserver {
	protected $typeAliasPattern;
	private $imgsLoad;
	
	public static function createObserver
		(JObservableInterface $observableObject, $parmas = array()) {
		$observer = new self($observableObject);
		$observer->typeAliasPattern = $parmas['typeAlias'];
		return $observer;
	}

	private function deleteFileImg() {
		if(property_exists($this->table, 'imgs')) {
			$reg = new Registry;
			$reg->loadString($this->table->imgs);
			if(count($reg) > 0) EcFile::delete($reg->toArray()); 
		}
	}
	
	public function onAfterLoad(&$result, $row) {
		if(property_exists($this->table, 'imgs'))
			$this->imgsLoad = $this->table->imgs; //EcDebug::log($this->imgsLoad, __method__);
	}
	
	public function onAfterStore(&$result) { //EcDebug::log($this->table->imgs);
		if((!(empty($this->imgsLoad))) && ($this->imgsLoad != $this->table->imgs)) {
			$reg = new Registry;
			$reg->loadString($this->imgsLoad);
			if(count($reg) > 0) EcFile::delete($reg->toArray());
			$this->imgsLoad = null;
		}
	}
	
	public function onBeforeDelete($pk) { $this->deleteFileImg(); }
	
	public function onBeforeStore($updateNulls, $tableKey) {
		$this->table->modified = date('Y-m-d H:i:s');
	}
}