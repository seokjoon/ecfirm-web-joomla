<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



JHtml::_('behavior.tabstate');
if (!JFactory::getUser()->authorise('core.manage', 'com_eccont')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR')); } 


	
define('ECPATH', JPATH_SITE.'/components/com_ec');
try { 
	JLoader::discover('', ECPATH.'/helpers');
	JLoader::discover('', JPATH_COMPONENT.'/helpers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR.'/helpers'); }
catch(Exception $e) { throw new RuntimeException('HELPERS not loaded'); }



$controller = JControllerLegacy::getInstance('Eccont');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();