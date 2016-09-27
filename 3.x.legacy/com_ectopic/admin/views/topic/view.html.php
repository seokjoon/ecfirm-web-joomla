<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicViewTopic extends EctopicViewItem	{

	/** * Add the page title and toolbar.
	 * @since   1.6 */
	protected function addToolbar() {
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->topic == 0);
		$canDo		= $this->canDo;
		JToolbarHelper::title
			(JText::_('COM_ECTOPIC_TOPIC'), 'pencil-2 article-add');
		if($isNew && $canDo->get('core.create')) {
			JToolbarHelper::apply('topic.apply');
			JToolbarHelper::save('topic.save'); 
		}
		elseif($canDo->get('core.edit') || ($canDo->get('core.edit.own')))	{
			JToolbarHelper::apply('topic.apply');
			JToolbarHelper::save('topic.save'); 
		}
		parent::addToolbar();
	}
}