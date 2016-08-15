<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



//https://docs.joomla.org/J3.x:Javascript_Frameworks
JHtml::_('behavior.framework'); //bootstrap framework
//JHtml::_('behavior.core'); //DELETE ME
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive'); //Keep session alive(editing or creating an article)



try { JLoader::discover('', ECPATH.'/views'); }
catch(Exception $e) { throw new RuntimeException('HELPERS not loaded'); }



class EctopicViewTopic extends EcViewForm {
	
	protected function getItem($valueKey) {
		if(empty(JFactory::getApplication()->input->get('task'))) { //default task
			//$modelCmt = $this->getModel('topiccmt');
			$modelTopiccmtForm = $this->getModel('topiccmtform');
			$this->topiccmtForm = $this->get('Form', 'topiccmtform');
			$modelTopiccmts = $this->getModel('topiccmts');
			$this->topiccmts = $this->get('Items', 'topiccmts');
			$this->topiccmtsPagination = $this->get('Pagination', 'topiccmts');
		}
		$model = $this->getModel($this->getName());
		$model->setState('enabledPlugin', true);
		return parent::getItem($valueKey);
	}
}