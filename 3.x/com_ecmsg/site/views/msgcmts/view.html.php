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



class EcmsgViewMsgcmts extends EcViewList {
	
	public function hide($valueCol) {
		$countCol = $this->getModel('msg')->getItem($valueCol)->msgcmt;
		echo EcWidget::spanCmt('com_ecmsg', 'msgcmts', array('msg'),
			$valueCol, 'show', $countCol);
		jexit();
	}
	
	public function show($valueCol) { //EcDebug::log($valueCol, __method__);
		$this->items = $this->getItems();
		$optionCom = JFactory::getApplication()->input->get('option');
		$nameKey = $this->nameKey;
		$this->form = $this->get('Form', ($nameKey.'form'));
		$nameCol = 'msg';
		$countCol = $this->getModel($nameCol)->getItem($valueCol)->$nameKey;
		echo EcWidget::spanCmt($optionCom, $this->getName(), array($nameCol), 
			$valueCol, 'hide', $countCol);
		require JPATH_COMPONENT.'/views/'.$this->getName().'/tmpl/default.php';
		jexit();
	}
	
	protected function getItems() {
		$model = $this->getModel($this->getName());
		if(($model->getState('list.limit', 20)) == 20) $model->setState('list.limit', 4);
		$model->setState('order', 'msgcmt DESC');
		$model->setState('joinUser', true);
		return parent::getItems();
	}
}