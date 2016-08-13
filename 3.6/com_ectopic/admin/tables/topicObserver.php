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
		if(property_exists($this->table, 'files'))
			$this->filesLoad = $this->table->files;
		if(property_exists($this->table, 'imgs'))
			$this->imgsLoad = $this->table->imgs; 
		$this->table->hit();
	}
	
	public function onAfterStore(&$result) { }
	
	public function onBeforeDelete($pk) { 
		$this->deleteFile();
		$this->deleteFileImg();
	}
	
	public function onBeforeLoad($keys, $reset) { }
	
	public function onBeforeStore($updateNulls, $tableKey) {
		$this->table->modified = date('Y-m-d H:i:s');
		$this->updateFile();
		$this->updateFileImg();
	}
	
	private function updateFile() {
		
	}
	
	private function updateFileImg() {
		if((!empty($this->table->imgs)) && ($this->imgsLoad != $this->table->imgs)) { //EcDebug::lp($this->imgsLoad);; EcDebug::lp($this->table->imgs); jexit();
			$reg = new JRegistry;
			if(!empty($this->imgsLoad)) $reg->loadString($this->imgsLoad);
			$this->table->imgs = (empty($this->table->imgs)) 
				? array() : json_decode($this->table->imgs, true);
			foreach ($this->table->imgs as $imgName => $imgValue)
				if(!empty($imgValue)) {
					EcFile::delete(array($reg->get($imgName))); //EcDebug::lp(array($reg->get($imgName)), true);
					$reg->set($imgName, $imgValue); //EcDebug::lp($reg, true);
			}
			$this->table->imgs = stripslashes($reg->toString());
		}
		$this->imgsLoad = null;
	}
}