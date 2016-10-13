<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class ModEcloginHelper
{

	/**
	 * Retrieve the url where the user should be returned after logging in
	 * @param   \Joomla\Registry\Registry  $params  module parameters
	 * @param   string                     $type    return type
	 * @return string
	 */
	public static function getReturnUrl($params, $type)
	{
		$app = JFactory::getApplication();
		$item = $app->getMenu()->getItem($params->get($type));
		$url = JUri::getInstance()->toString(); // Stay on the same page

		if ($item) {
			$lang = '';
			if (JLanguageMultilang::isEnabled() && $item->language !== '*')
				$lang = '&lang=' . $item->language;
			$url = 'index.php?Itemid=' . $item->id . $lang;
		}

		return base64_encode($url);
	}
}