<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcDatetime	{

	public static function getTime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	public static function interval($date)	{
		$interval = strtotime('now') - strtotime($date);
		$minute = ceil($interval / 60); $hour = floor($minute / 60);
		$day = floor($hour / 24); $month = floor($day / 30);
		//if($month >= 1) $interval = $month.JText::_('COM_EC_INTERVAL_MONTH');
		if($month >= 1) $interval = JHtml::_('date', $date, JText::_('COM_EC_DATE_FORMAT_1'));
		else if($day >= 1) $interval = $day.JText::_('COM_EC_DATE_DAY');
		else if($hour >= 1) $interval = $hour.JText::_('COM_EC_DATE_HOUR');
		else $interval = $minute.JText::_('COM_EC_DATE_MINUTE');
		return $interval;
	}

}