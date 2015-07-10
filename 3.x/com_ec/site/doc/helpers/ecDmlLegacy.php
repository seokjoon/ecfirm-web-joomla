<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcDmlLegacy {
	
	public static function deleteByColumn($nameCol, $valueCol, $nameKey)	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->delete('#__ec_'.$nameKey);
		$query->where($nameCol.' = '.$valueCol);
		$db->setQuery($query);
		return $db->execute();
	}
	
	public static function getColumn($nameCol, $valueKey, $nameKey, $nameCom)	{
		$table = JTable::getInstance($nameKey, ucfirst($nameCom).'Table');
		try { $table->load($valueKey);
			return $table->$nameCol; }
		catch (Exception $e) { //$this->setError($e->getMessage());
			EcDebug::lp($e->getMessage());
			return false; }
	}
	
	public static function getColumnByParams($params, $nameKey) {
		if(!isset($params['columns']) || empty($params['columns'])) 
			$params['columns'] = $nameKey; 
		if(!isset($params['table']) || empty($params['table']))
			$params['table'] = '#__ec_'.$nameKey;
		else $params['table'] = '#__ec_'.$params['table'];
		$where = '';
		foreach ($params['where'] as $key => $value) {
			$where .= $key.'="'.$value.'"';
			unset($params['where'][$key]);
			if(count($params['where']) > 0) $where .= ' AND '; }
		//EcDbug::log('===='); EcDebug::log($where); EcDebug::log('====');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($params['columns'])
			->from($params['table'])
			->where($where);
		$db->setQuery($query);
		if($params['out'] == 'result') return $db->loadResult();
		else if($params['out'] == 'column') return $db->loadColumn();
		else if($params['out'] == 'row') return $db->loadRow();
		else if($params['out'] == 'objectList') return $db->loadObjectList();
		else if($params['out'] == 'assocList') return $db->loadAssocList();
	}
	
	public static function getColumnByValue
		($nameCol, $valueCol, $nameKey, $desc) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($nameKey)
			->from('#__ec_'.$nameKey)
			->where($nameCol.'='.$db->quote($valueCol));
		if(!empty($desc)) $query->order($nameKey.' '.$desc);
		$db->setQuery($query); //ecDebug::log($db->getQuery());
		return $db->loadResult();
	}	
	
	public static function getColumns
		($nameCol, $valueCol, $nameKey, $desc, $limit, $limitstart) {
		if((is_string($valueCol)) || (!(is_numeric($valueCol)))) $valueCol = '"'.$valueCol.'"';
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($nameKey)->from('#__ec_'.$nameKey);
		if(!empty($nameCol) && !empty($valueCol)) $query->where($nameCol.'='.$valueCol);
		if(!empty($desc)) $query->order($nameKey.' '.$desc);
		$db->setQuery($query, $limitstart, $limit); //ecDebug::log($query);
		return $db->loadColumn();
	}
	
	public static function updateColumnCount
		($nameCom, $nameKey, $valuesKey, $nameCol, $valueCol) {
		if(!(is_array($valuesKey))) $valuesKey = array($valuesKey);
		$table = JTable::getInstance($nameKey, ucfirst($nameCom).'Table');
		foreach ($valuesKey as $valueKey) {
			if(!$table->load($valueKey)) return false;
			$item[$nameKey] = $valueKey;
			$item[$nameCol] = (int)$table->$nameCol + (int)$valueCol;
			$bool = $table->save($item);
			if(!$bool) return $bool; }
		return $bool;
	}
}