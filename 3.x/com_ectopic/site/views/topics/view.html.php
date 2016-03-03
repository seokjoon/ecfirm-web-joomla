<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



//https://docs.joomla.org/J3.x:Javascript_Frameworks
JHtml::_('behavior.framework'); //bootstrap framework
//JHtml::_('behavior.core'); //DELETE ME
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive'); //Keep session alive(editing or creating an article)



try { JLoader::discover('', ECPATH.'/views'); }
catch(Exception $e) { throw new RuntimeException('HELPERS not loaded'); }



class EctopicViewTopics extends EcViewList {
	
	protected function getItems() {
		$model = $this->getModel($this->getName());
		$model->setState('order', $this->nameKey.' DESC');//('order', 'modified DESC');
		$model->setState('enabledPlugin', true);
		$model->setState('joinUser', true);
		$limit = $model->getState();
		return parent::getItems();
	}
}