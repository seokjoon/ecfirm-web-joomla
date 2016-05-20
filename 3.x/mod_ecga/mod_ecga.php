<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$idTrack = $params->get('idTrack');

require JModuleHelper::getLayoutPath
	('mod_ecga', $params->get('layout', 'default'));