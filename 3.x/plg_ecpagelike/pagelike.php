<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class PlgEcPagelike extends JPlugin {
	
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 * @var    boolean
	 * @since  3.1 */
	protected $autoloadLanguage = true;
	
	//public function onPagePrepareDisplay($context, &$item) { }
	
	//public function onPageBeforeDisplay($context, &$item) { }
	
	public function onPageAfterDisplay($context, &$item) {
		$optionCom = 'com_ecpage';
		$nameKey = 'pagelike';
		$nameCol = 'page';
		$valueCol = $item->$nameCol;
		$params['where'] = 
			array($nameCol => $valueCol, 'user' => JFactory::getUser()->id);
		$valueKey = (int)EcDml::selectByParams($params, $nameKey);
		$task = ($valueKey > 0) ? 'delete' : 'add';
		$params = array();
		$params['optionCom'] = $optionCom;
		$params['nameKey'] = $nameKey;
		$params['valueKey'] = $valueKey;
		$params['nameCol'] = $nameCol;
		$params['valueCol'] = $valueCol;
		$params['task'] = $task;
		$params['countKey'] = $item->$nameKey;
		$result = EcpageWidget::likespan($params);
		return $result;
	}
}