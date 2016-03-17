<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicViewTopics extends EcViewList {
	
	/** * Add the page title and toolbar.
	 * @since   1.6 */
	protected function addToolbar() {
		$user = JFactory::getUser();
		$canDo = $this->canDo;
		if ($canDo->get('core.create'))	JToolbarHelper::addNew('topic.add');
		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))	{
			JToolbarHelper::editList('topic.edit');
			JToolbarHelper::custom('topics.ondisplay', 'publish.png', '',
				'COM_ECTOPIC_ON_DISPLAY');
			JToolbarHelper::custom('topics.offdisplay', 'checkin.png', '',
				'COM_ECTOPIC_OFF_DISPLAY'); 
		}
		if ($canDo->get('core.delete'))
			JToolbarHelper::deleteList('', 'topics.delete', 'COM_ECTOPIC_DELETE');
		parent::addToolbar();
	}
}