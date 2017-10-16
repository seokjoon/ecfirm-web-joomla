<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die('Restricted access');

HTMLHelper::_('behavior.tabstate');
if (! Factory::getUser()->authorise('core.manage', 'com_ec')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

try {
	JLoader::discover('', JPATH_COMPONENT . '/helpers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR . '/controllers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR . '/helpers');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR . '/models');
	JLoader::discover('', JPATH_COMPONENT_ADMINISTRATOR . '/views');
} catch (Exception $e) {
	throw new RuntimeException('HELPERS not loaded');
}

$controller = BaseController::getInstance('Ec');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();