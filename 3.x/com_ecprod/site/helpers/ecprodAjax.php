<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcprodAjax {
	
	/**
	 * @param array $params
	 * - essential: optionCom, nameKey, valueKey, task, id, validate
	 * - optional: nameCol, valueCol, nameCols, idPostfix, post, li */
	public static function submit($params) {
		extract($params);
		$extra = null;
		$out = $id;
		
	}
	
}