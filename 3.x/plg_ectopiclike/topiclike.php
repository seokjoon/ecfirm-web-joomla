<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class PlgEcTopiclike extends JPlugin {
	
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 * @var    boolean
	 * @since  3.1 */
	protected $autoloadLanguage = true;
	
	//public function onTopicPrepareDisplay($context, &$item) { }
	
	//public function onTopicBeforeDisplay($context, &$item) { }
	
	public function onTopicAfterDisplay($context, &$item) {
		$optionCom = 'com_ectopic';
		$nameKey = 'topiclike';
		$nameCol = 'topic';
		$valueCol = $item->$nameCol;
		$params['where'] = 
			array($nameCol => $valueCol, 'user' => JFactory::getUser()->id);
		$valueKey = EcDml::selectByParams($params, $nameKey);
		$task = ($valueKey > 0) ? 'delete' : 'add';
		$params = array();
		$params['optionCom'] = $optionCom;
		$params['nameKey'] = $nameKey;
		$params['valueKey'] = $valueKey;
		$params['nameCol'] = $nameCol;
		$params['valueCol'] = $valueCol;
		$params['nameCols'] = array($nameCol);
		$params['task'] = $task;
		$params['countKey'] = $item->$nameKey;
		$result = EcWidget::likeSpan($params);
		return $result;
	}
}