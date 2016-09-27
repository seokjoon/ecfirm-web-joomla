<?php /** @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



require_once dirname(__FILE__).'/helper.php';



//echo '<pre>'.print_r($params, 1).'</pre>';
$topics = ModEctopicHelper::getTopics($params);
$itemId = ModEctopicHelper::getItemId($params);



require JModuleHelper::getLayoutPath('mod_ectopic', $params->get('layout', 'default'));