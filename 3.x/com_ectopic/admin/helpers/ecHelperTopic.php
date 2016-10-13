<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcHelperTopic extends EcHelperAdmin
{

	/** * Configure the Linkbar.
	 * @param   string  $vName  The name of the active view.
	 * @return  void
	 * @since   1.6 */
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(JText::_('COM_ECTOPIC_SUBMENU_TOPICCATS'), 
			'index.php?option=com_ectopic&view=topiccats', $vName == 'topiccats');
		JHtmlSidebar::addEntry(JText::_('COM_ECTOPIC_SUBMENU_TOPICS'), 
			'index.php?option=com_ectopic&view=topics', $vName == 'topics');
	}

	public static function getStateValues()
	{
		return array(
			'' => JText::_('COM_ECTOPIC_TOPICCAT_STATE_VALUE_SELECT'),
			'2' => JText::_('COM_ECTOPIC_TOPICCAT_STATE_VALUE_S2'),
			'1' => JText::_('COM_ECTOPIC_TOPICCAT_STATE_VALUE_S1')
		);
	}
}