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



class EcmsgViewMsglike extends EcViewItemAjax {
	
	public function delete($valueCol) {
		$model = $this->getModel('msg');
		$countKey = $model->getItem($valueCol)->msglike;
		echo EcWidget::spanLike
			('com_ecmsg', 'msglike', 0, array('msg'), $valueCol, 'add', $countKey);
		jexit();
	}
	
	public function save($valueCol) {
		$nameKey = $this->nameKey;
		$model = $this->getModel('msg');
		$countKey = $model->getItem($valueCol)->$nameKey;
		$params['where'] = array('msg' => $valueCol, 'user' => JFactory::getUser()->id);
		$valueKey = EcDml::selectByParams($params, $nameKey);
		echo EcWidget::spanLike('com_ecmsg', $nameKey, $valueKey, array('msg'), 
			$valueCol, 'delete', $countKey);
		jexit();
	}
}