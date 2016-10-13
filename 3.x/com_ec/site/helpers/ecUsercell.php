<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

/**
 * @deprecated
 */
class EcUsercell
{

	/**
	 * @see 단일 그룹 사용자
	 */
	public static function getUserGroup()
	{
		$user = JFactory::getUser();
		$userGroup = EcConst::USER_GROUP_GUEST;

		foreach ($user->groups as $g)
			$userGroup = $g; //XX

		return $userGroup;
	}
}