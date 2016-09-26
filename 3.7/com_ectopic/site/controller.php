<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicController extends EcControllerLegacy {
	
	protected function allowAdd($data = array()) { //plural&singular display
		return EcPermit::allowAdd();
	}
	
	protected function allowEdit($data = array(), $nameKey = null) { //plural&singular display
		if(empty($nameKey)) $nameKey = $this->input->getCmd('view', 'topic', 'string');
		$valueKey = (empty($data)) ? $this->input->get($nameKey, 0, 'uint') : $data[$nameKey];
		if((empty($nameKey)) || ($valueKey == 0)) return false; //plural display
		$model = $this->getModel($nameKey);
		$item = $model->getItem($valueKey);
		return EcPermit::allowEdit($item); //singular display
	}
	
	public function display($cachable = false, $urlparams = array()) {
		$nameView = $this->input->get('view');
		switch ($nameView) {
			case 'topic' :
				$this->setViewModel('topiccmtform', $nameView);
				$this->setViewModel('topiccmts', $nameView);
				break;
			case 'topics' : 
				$this->setViewModel('topiccat');
				break;
		}
		return parent::display($cachable, $urlparams);
	}
}