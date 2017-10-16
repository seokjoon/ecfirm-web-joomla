<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */

use Joomla\CMS\Access\Access;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Object\CMSObject;

defined('_JEXEC') or die('Restricted access');

class EcHelperAdmin extends ContentHelper //JHelperContent
{

	public static function getActionsEc($id = null, $section = 'component')
	{
		$user = Factory::getUser();
		$result = new CMSObject(); //new JObject();
		
		$path = JPATH_COMPONENT_ADMINISTRATOR . '/access.xml';
		
		if ($section == 'component')
			$assetName = $id;
		else
			$assetName = $id . '.' . $section;
		
		if (isset($id) && ! empty($id))
			$assetName .= '.' . $id;
		
		$actions = Access::getActionsFromFile($path, "/access/section[@name='" . $section . "']/");
		
		foreach ($actions as $action)
			$result->set($action->name, $user->authorise($action->name, $assetName));

		return $result;
	}
}