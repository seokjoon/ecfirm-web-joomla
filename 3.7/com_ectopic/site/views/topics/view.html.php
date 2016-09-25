<?php /** @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
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
		$model = $this->getModel('topiccat');
		$itemTopiccat = $model->getItem(EctopicUrl::getTopiccat());
		$this->topiccatTitle = $itemTopiccat->title;
		$this->topiccatBody = $itemTopiccat->body;
		
		$model = $this->getModel($this->getName());
		$model->setState('enabledPlugin', true);
		$items = parent::getItems();
		
		$this->filterForm = $this->get('FilterForm'); //@IMPORTANT: filter call sequence
		//$this->activeFilters = $this->get('ActiveFilters'); 
		return $items;
	}
}