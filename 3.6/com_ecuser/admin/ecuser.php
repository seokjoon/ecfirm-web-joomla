<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



JHtml::_('behavior.tabstate');
if (!JFactory::getUser()->authorise('core.manage', 'com_ecuser')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR')); } 


	
define('ECPATH', JPATH_SITE.'/components/com_ec');
define('ECPATH_ADMINISTRATOR', JPATH_ADMINISTRATOR.'/components/com_ec');
try {
	JLoader::discover('', ECPATH.'/helpers');
	JLoader::discover('', ECPATH_ADMINISTRATOR.'/controllers');
	JLoader::discover('', ECPATH_ADMINISTRATOR.'/helpers');
	JLoader::discover('', ECPATH_ADMINISTRATOR.'/models');
	JLoader::discover('', ECPATH_ADMINISTRATOR.'/views');
	JLoader::discover('', JPATH_COMPONENT.'/helpers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR.'/helpers'); 
} catch(Exception $e) { throw new RuntimeException('HELPERS not loaded'); }



$controller = JControllerLegacy::getInstance('Ecuser');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();