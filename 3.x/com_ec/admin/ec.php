<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



JHtml::_('behavior.tabstate');
if (!JFactory::getUser()->authorise('core.manage', 'com_ec')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR')); } 



try {
	JLoader::discover('', JPATH_COMPONENT.'/helpers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR.'/controllers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR.'/helpers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR.'/models');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR.'/views');
}
catch(Exception $e) { throw new RuntimeException('HELPERS not loaded'); }
	


$controller = JControllerLegacy::getInstance('Ec');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();