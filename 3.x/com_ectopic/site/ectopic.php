<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tabstate');

define('ECPATH', JPATH_SITE . '/components/com_ec');
try {
	JLoader::discover('', ECPATH . '/helpers');
	JLoader::discover('', ECPATH . '/models');
	JLoader::discover('', ECPATH . '/controllers');
	//JLoader::discover('', ECPATH.'/views');
	JLoader::discover('', JPATH_COMPONENT . '/helpers');
} catch (Exception $e) {
	throw new RuntimeException('HELPERS not loaded');
}

$controller = JControllerLegacy::getInstance('Ectopic');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();