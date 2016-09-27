<?php /** @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



require_once dirname(__FILE__).'/helper.php';



//echo '<pre>'.print_r($params, 1).'</pre>';
$type = $params->get('type'); 
$events = ModEcgithubHelper::getActivityEvent($params, $type); //echo '<pre>'.print_r($events[0], 1).'</pre>';
$timeCache = ModEcgithubHelper::getTimeCache($params, $type);
require JModuleHelper::getLayoutPath('mod_ecgithub', $type.'_'.$params->get('layout_mod'));