<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



require_once dirname(__FILE__).'/helper.php';
JLoader::register('EcUrl', JPATH_SITE . '/components/com_ec/helpers/ecUrl.php');


//echo '<pre>'.print_r($params, 1).'</pre>';
$topics = ModEctopicHelper::getTopics($params);
$itemId = EcUrl::getItemIdByCat('com_ectopic', 'topiccat', $params->get('topiccat'));



require JModuleHelper::getLayoutPath('mod_ectopic', $params->get('layout', 'default'));