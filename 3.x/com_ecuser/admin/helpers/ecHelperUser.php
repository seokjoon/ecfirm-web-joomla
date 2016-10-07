<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcHelperUser extends EcHelperAdmin {

	/** * Configure the Linkbar.
	 * @param   string  $vName  The name of the active view.
	 * @return  void
	 * @since   1.6 */
	public static function addSubmenu($vName) {
		JHtmlSidebar::addEntry(JText::_('COM_ECUSER_SUBMENU_USERS'),
			'index.php?option=com_ecuser&view=users', $vName == 'users');
	}
}