<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



/* //https://docs.joomla.org/J3.x:Javascript_Frameworks
JHtml::_('behavior.framework'); //bootstrap framework
//JHtml::_('behavior.core'); //DELETE ME
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive'); //Keep session alive(editing or creating an article) */



try { JLoader::discover('', ECPATH.'/views'); }
catch(Exception $e) { throw new RuntimeException('HELPERS not loaded'); }



class EctopicViewTopiccmts extends EcViewList {
	
	public function hide($valueCol) {
		$countCol = $this->getModel('topic')->getItem($valueCol)->topiccmt;
		$params['optionCom'] = $this->optionCom;
		$params['nameKey'] = 'topiccmts';
		$params['nameCol'] = 'topic';
		$params['valueCol'] = $valueCol;
		$params['nameCols'] = array('topic');
		$params['task'] = 'show';
		$params['countKey'] = $countCol;
		echo EcWidget::cmtSpan($params);
		jexit();
	}
	
	public function show($valueCol) {
		$this->items = $this->getItems();
		$nameKey = $this->nameKey;
		$this->form = $this->get('Form', ($nameKey.'form'));
		$nameCol = 'topic';
		$countCol = $this->getModel($nameCol)->getItem($valueCol)->$nameKey;
		$params['optionCom'] = $this->optionCom;
		$params['nameKey'] = $this->getName();
		$params['nameCol'] = $nameCol;
		$params['valueCol'] = $valueCol;
		$params['nameCols'] = array($nameCol);
		$params['task'] = 'hide';
		$params['countKey'] = $countCol;
		echo EcWidget::cmtSpan($params);
		require JPATH_COMPONENT.'/views/'.$this->getName().'/tmpl/default.php';
		jexit();
	}
	
	protected function getItems() {
		$model = $this->getModel($this->getName());
		if(($model->getState('list.limit', 20)) == 20) $model->setState('list.limit', 4);
		$model->setState('order', 'topiccmt DESC');
		$model->setState('joinUser', true);
		return parent::getItems();
	}
}