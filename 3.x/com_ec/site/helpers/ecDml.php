<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcDml {
	
	public static function deleteByColumn($nameCol, $valueCol, $nameKey)	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->delete('#__ec_'.$nameKey);
		$query->where($nameCol.' = '.$valueCol);
		$db->setQuery($query);
		return $db->execute();
	}
	
	public static function loadTable($nameCol, $valueKey, $nameKey, $nameCom) {
		$table = JTable::getInstance($nameKey, ucfirst($nameCom).'Table');
		try { $table->load($valueKey); return $table; /* ->$nameCol; */ }
		catch (Exception $e) { //$this->setError($e->getMessage());
			EcDebug::lp($e->getMessage());
			return false; }
	}

	/**
	 * @param array $params: columns, format, limit, limitstart, order, table, where
	 * @param string $nameKey
	 * @return result, row, assoc, object, column, , rowList, assocList, objectList */
	public static function selectByParams($params, $nameKey) {
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
		//EcDebug::log('===='); EcDebug::log($where); EcDebug::log('====');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($params['columns'])
			->from($params['table'])
			->where($where);
		if((isset($params['order'])) && (!empty($params['order'])))
			$query->order($nameKey.' '.$params['order']);
		if((isset($params['limit'])) && (isset($params['limitstart'])))
			$db->setQuery($query, $limitstart, $limit);
		else $db->setQuery($query);
		$params['format'] = ((isset($params['format']) && (!empty($params['format']))))
			? $params['format'] : 'result';
		$out = 'load'.ucfirst($params['format']);
		//EcDebug::log($out); //EcDebug::log($db->$out());
		return $db->$out();
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