<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

use Joomla\Registry\Registry;

class EcuserModelUser extends EcModelItem
{

	protected function canDelete($record)
	{ //JTable object
		$bool = ((JFactory::getUser()->id) == ($record->user));
		//if(!$bool) $bool = parent::canDelete($record);

		$table = $this->getTable('User', 'JTable');
		$table->load($record->user); //EcDebug::log($table);

		$app = JFactory::getApplication();

		$jform = $app->input->post->get('jform', array(), 'array');
		if ($bool)
			$bool = ($table->username == $jform['username']);
		if ($bool)
			$bool = ($table->email == $jform['email']);
		if ($bool)
			$bool = password_verify($jform['password'], $table->password);
		
		return $bool;
	}

	public function delete(&$valueKeys)
	{
		$bool = parent::delete($valueKeys);
		
		if ($bool) {
			$valueKeys = (array) $valueKeys;
			foreach ($valueKeys as $valueKey) {
				$ju = JFactory::getUser($valueKey);
				if (! ($ju->delete())) {
					$this->setError($ju->getError());
					return false;
				}
			}
		}

		return $bool;
	}

	/** Method to get article data.
	 * @param   integer  $itemId  The id of the article.
	 * @return  mixed  Content item data object on success, false on failure.
	 * @since 12.2 JModelAdmin */
	public function getItem($valueKey = null)
	{
		$item = parent::getItem($valueKey);
		if (empty($item))
			return $item;
		
		if ($item->user > 0) {
			$table = $this->getTable('User', 'JTable');
			$table->load($item->user); //EcDebug::log($table);
			$item->name = $table->name;
			$item->username = $table->username;
			$item->email = $table->email;
			$item->registerDate = $table->registerDate;
			$item->lastvisitDate = $table->lastvisitDate;
			$item->activation = $table->activation;
			$item->groups = JUserHelper::getUserGroups($item->user);
		} //EcDebug::lp($item);

		return $item;
	}

	public function save($data)
	{
		//$task = JFactory::getApplication()->input->get('task');	
		//if(($data['user'] == 0) && ($task != 'register')) return false;
		if ($data['user'] == 0)
			return false;
		
		foreach ($data as $key => $value) {
			if ($key == $this->name)
				continue;
			else 
				if (((is_numeric($value)) && ($value == 0)) || ((is_string($value)) && (($value == ''))) || ($value == null))
					unset($data[$key]);
		}
		
		$ju = JUser::getInstance($data['user']); //if user is zero then return new JUser
		if (! ($ju->bind($data))) {
			$this->setError('bind: ' . $ju->getError());
			return false;
		}
		if (! ($ju->save())) {
			$this->setError('save: ' . $ju->getError());
			return false;
		}
		
		/*
		 * if($data['user'] == 0) {
		 * JUserHelper::addUserToGroup($ju->id, EcConst::USER_GROUP_REGISTERED);
		 * EcDml::insertRecord(array($this->name => $ju->id), $this->name);
		 * $data['user'] = $ju->id;
		 * }
		 */
		
		EcDml::insertRecord(array(
			$this->name => $ju->id
		), $this->name);
		
		if ((isset($data['urlDefault'])) && (! empty($data['urlDefault']))) { //EcDebug::lp($data, true);
			if ((strpos($data['urlDefault'], 'https://') !== false) || (strpos($data['urlDefault'], 'http://') !== false))
				$urlPrefix = true;
			if (! $urlPrefix)
				$data['urlDefault'] = 'http://' . $data['urlDefault'];
		}
		
		$item = $this->getItem($data['user']);
		
		$reg = new Registry();
		$reg->loadString($item->urls);
		$reg->set('default', $data['urlDefault']);
		$data['urls'] = $reg->toString();
		
		return parent::save($data);
	}
}