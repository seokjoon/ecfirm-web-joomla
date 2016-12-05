<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcUser
{

	public static function isGroup($in, $user = null)
	{
		if (empty($user))
			$user = JFactory::getUser();
		
		foreach ($user->groups as $group)
			if ($group == $in)
				return true;
			
		return false;
	}
}