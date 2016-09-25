<?php /** @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicViewTopics extends EcViewListAdmin {

	protected function addToolbar() {
		parent::addToolbar();
		$user = JFactory::getUser();
		$bar = JToolBar::getInstance('toolbar');
		$canDo = $this->canDo;
		if($canDo->get('core.create')) JToolbarHelper::addNew('topic.add');
		if(($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
			JToolbarHelper::editList('topic.edit');
		}
		if($canDo->get('core.delete'))
			JToolbarHelper::deleteList('', 'topics.delete', 'COM_ECTOPIC_DELETE');
	}
}