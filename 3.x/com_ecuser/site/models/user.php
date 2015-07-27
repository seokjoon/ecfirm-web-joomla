<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcuserModelUser extends EcModelItem	{
	
	public function delete(&$valueKeys) { //TODO
	
		return parent::delete($valueKeys);
	}
	
	/** Method to get article data.
	 * @param   integer  $itemId  The id of the article.
	 * @return  mixed  Content item data object on success, false on failure.
	 * @since 12.2 JModelAdmin */
	public function getItem($keyValue = null)	{ //EcDebug::log(__method__);
		$item = parent::getItem($keyValue); 
		if(empty($item)) return $item;
		if(($this->getState('joinUser')) && ($item->user > 0)) {
			$table = $this->getTable('User', 'JTable');
			$table->load($item->user); //EcDebug::log($table);
			$item->username = $table->username;
			$item->name = $table->name;
			$item->email = $table->email; } //EcDebug::lp($item);
		return $item;
	}
	
	public function save($data) {
		foreach($data as $key => $value) {
			if($key == $this->name) continue;
			else if(((is_numeric($value)) && ($value == 0)) 
				|| ((is_string($value)) && (($value == ''))) || ($value == null))
				unset($data[$key]); }
		$ju = JUser::getInstance($data['user']);//if user is zero then return new JUser
		if(!($ju->bind($data))) { $this->setError('bind', $ju->getError()); return false; }
		if(empty($ju->name)) $ju->name = $ju->username;
		//if new then user id assigned
		if(!($ju->save())) { $this->setError('save', $ju->getError()); return false; }
		if($data['user'] == 0) return EcDml::insertRecord
			(array($this->name => $ju->id), $this->name);	
		else return parent::save($data);
	}
}