<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcUsercell {
	
	/*
	 * @see 상점 개수 적고 상점->상점 사용자 간 단일 매핑
	 * @see 단일 그룹 사용자
	 * @todo user state 활용
	public static function getShop() {
		$user = JFactory::getUser();
		$userGroup = self::getUserGroup();
		$shop = EcConst::USER_GROUP_NOT_DEFINED;
		switch($userGroup) {
			case EcConst::USER_GROUP_REGISTERED : 
				$params['columns'] = 'shop';
				$params['where'] = array('user' => $user->id);
				$shop = EcDml::selectByParams($params, 'user');
				break;
			case EcConst::USER_GROUP_EDITOR : 
				$params['where'] = array('user' => $user->id);
				$shop = EcDml::selectByParams($params, 'shop');
				break;
			case EcConst::USER_GROUP_SUPERUSER : 
				$shop = 0;
				break;
		}
		return $shop;
	} */

	/**
	 * @see 단일 그룹 사용자 */
	public static function getUserGroup() {
		$user = JFactory::getUser();
		$userGroup = EcConst::USER_GROUP_GUEST;
		foreach ($user->groups as $g) $userGroup = $g; //XX
		return $userGroup;
	}
}