<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicViewTopiccats extends EcViewListAdmin {

	protected function addToolbar() {
		parent::addToolbar();
		$user = JFactory::getUser();
		$bar = JToolBar::getInstance('toolbar');
		$canDo = $this->canDo;
		if($canDo->get('core.create')) JToolbarHelper::addNew('topiccat.add');
		if(($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
			JToolbarHelper::editList('topiccat.edit');
		}
		if($canDo->get('core.delete'))
			JToolbarHelper::deleteList('', 'topiccats.delete', 'COM_ECTOPIC_DELETE');
	}
}