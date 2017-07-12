<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcConst
{
	const USER_GROUP_ADMINISTRATOR = 7;

	const USER_GROUP_AUTHOR = 3;

	const USER_GROUP_EDITOR = 4;

	const USER_GROUP_GUEST = 9;

	const USER_GROUP_NOT_DEFINED = - 1;

	const USER_GROUP_PUBLIC = 1;

	const USER_GROUP_REGISTERED = 2;

	const USER_GROUP_SUPERUSER = 8;

	private static $prefix = 'ec';

	public static function getPrefix()
	{
		return self::$prefix;
	}

	public static function setPrefix($namePrefix)
	{
		self::$prefix = $namePrefix;
	}
}