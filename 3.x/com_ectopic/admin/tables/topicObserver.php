<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
use Joomla\Registry\Registry;



class EctopicTableTopicObserver extends JTableObserver {
	private $filesLoad;
	private $imgsLoad;
	private $typeAliasPattern;
	
	public static function createObserver
		(JObservableInterface $observableObject, $parmas = array()) {
		$observer = new self($observableObject);
		$observer->typeAliasPattern = $parmas['typeAlias'];
		return $observer;
	}
	
	private function deleteFile() {
		if(property_exists($this->table, 'files')) {
			$reg = new Registry;
			$reg->loadString($this->table->files);
			if(count($reg) > 0) EcFile::delete($reg->toArray());
		}
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
		if(property_exists($this->table, 'files'))
			$this->filesLoad = $this->table->files;
	}
	
	public function onAfterStore(&$result) { //EcDebug::log($this->table->imgs);
		if((!(empty($this->imgsLoad))) && ($this->imgsLoad != $this->table->imgs)) {
			$reg = new Registry;
			$reg->loadString($this->imgsLoad);
			if(count($reg) > 0) EcFile::delete($reg->toArray());
			$this->imgsLoad = null;
		}
		if((!(empty($this->filesLoad))) && ($this->filesLoad != $this->table->files)) {
			$reg = new Registry;
			$reg->loadString($this->filesLoad);
			if(count($reg) > 0) EcFile::delete($reg->toArray());
			$this->filesLoad = null;
		}
	}
	
	public function onBeforeDelete($pk) { 
		$this->deleteFile();
		$this->deleteFileImg();
	}
	
	public function onBeforeStore($updateNulls, $tableKey) {
		$this->table->modified = date('Y-m-d H:i:s');
	}
}