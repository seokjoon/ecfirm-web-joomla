<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

//Include the login functions only once
JLoader::register('ModEcloginHelper', __DIR__ . '/helper.php');
//echo '<pre>'.print_r($params, 1).'</pre>';


$user = JFactory::getUser();
$type = (! $user->get('guest')) ? 'logout' : 'login';
$return = ModEcloginHelper::getReturnUrl($params, $type);
$layout = $params->get('layout', 'vertical');

// Logged users must load the logout sublayout
if (! $user->guest)
	$layout .= '_logout';

require JModuleHelper::getLayoutPath('mod_eclogin', $layout);