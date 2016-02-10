<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcViewItemLike extends EcViewItemAjax {
	
	public function addCancel() {
		$params['optionCom'] = $this->optionCom;
		$params['nameKey'] = $this->nameKey;
		$params['valueKey'] = 0;
		$params['task'] = 'addCancel';
		echo EcWidget::confirmModal($params);
		jexit();
	}
	
	public function delete($valueCol) {
		$nameKey = $this->nameKey;
		$nameCol = str_replace('like', '', $nameKey);
		$model = $this->getModel($nameCol);
		$countKey = $model->getItem($valueCol)->$nameKey;
		$params['optionCom'] = $this->optionCom;
		$params['nameKey'] = $nameKey;
		$params['valueKey'] = 0;
		$params['nameCol'] = $nameCol;
		$params['valueCol'] = $valueCol;
		$params['nameCols'] = array($nameCol);
		$params['task'] = 'add';
		$params['countKey'] = $countKey;
		echo EcWidget::likeSpan($params);
		jexit();
	}
	
	public function save($valueCol) { 
		$nameKey = $this->nameKey;
		$nameCol = str_replace('like', '', $nameKey);
		$model = $this->getModel($nameCol);
		$countKey = $model->getItem($valueCol)->$nameKey;
		$params['where'] = array($nameCol => $valueCol, 'user' => JFactory::getUser()->id);
		$valueKey = EcDml::selectByParams($params, $nameKey);
		$params['optionCom'] = $this->optionCom;
		$params['nameKey'] = $nameKey;
		$params['valueKey'] = $valueKey;
		$params['nameCol'] = $nameCol;
		$params['valueCol'] = $valueCol;
		$params['nameCols'] = array($nameCol);
		$params['task'] = 'delete';
		$params['countKey'] = $countKey;
		echo EcWidget::likeSpan($params);
		jexit();
	}
}