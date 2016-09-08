<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



require_once dirname(__FILE__).'/helper.php';



//echo '<pre>'.print_r($params, 1).'</pre>';
$commits = ModEcgithubHelper::getActivityEventCommits($params);
//echo '<pre>'.print_r($commits[0], 1).'</pre>';



require JModuleHelper::getLayoutPath('mod_ecgithub', $params->get('layout', 'default'));