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



class EcuserViewUser extends EcViewItemForm {
	
	public function editForm() {
		$layout = JFactory::getApplication()->input->get('layout', null, 'string');
		$nameModelForm = (empty($layout)) ? $this->nameKey.'form' : $layout.'form';
		$this->getModel($nameModelForm)->setState('joinUser', true);
		$this->form = $this->get('Form', $nameModelForm);
		parent::display(null);
	}
	
	protected function getItem($valueKey) {
		$model = $this->getModel($this->getName());
		$model->setState('enabledPlugin', true);
		$model->setState('joinUser', true);
		return parent::getItem($valueKey);
	}
}