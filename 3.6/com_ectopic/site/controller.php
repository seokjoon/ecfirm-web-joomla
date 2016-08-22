<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicController extends EcControllerLegacy {
	
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