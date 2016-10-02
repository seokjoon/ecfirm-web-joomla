<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');
JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');



echo '<form action="'.JRoute::_(JUri::getInstance(), true, $params->get('usesecure'))
	.'" method="post" id="login-form" class="form-inline">';

echo '</form>';