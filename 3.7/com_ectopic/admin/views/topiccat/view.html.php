<?php /** @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicViewTopiccat extends EcViewItemAdmin {

	protected function addToolbar() {
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->topiccat == 0);
		$canDo		= $this->canDo;
		JToolbarHelper::title
		(JText::_('COM_ECTOPIC_TOPICCAT'), 'pencil-2 article-add');
		if($isNew && $canDo->get('core.create')) {
			JToolbarHelper::apply('topiccat.apply');
			JToolbarHelper::save('topiccat.save');
		}
		elseif($canDo->get('core.edit') || ($canDo->get('core.edit.own')))	{
			JToolbarHelper::apply('topiccat.apply');
			JToolbarHelper::save('topiccat.save');
		}
		parent::addToolbar();
	}
}