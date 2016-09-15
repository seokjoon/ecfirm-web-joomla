<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
//use Joomla\Github\Github;
use Joomla\Registry\Registry;



class ModEcgithubHelper {
	
	private static function _getActivityEvent($params, $type) {
		$out = array();
		$git = self::getGithub($params);
		switch ($type) {
			case 'commits' :
			case 'default' :
				$src = $git->activity->events->getRepository
					($params->get('username'), $params->get('repository'));
				foreach ($src as $s) if($s->type == 'PushEvent') array_push($out, $s);
				break;
			case 'issues':
				$src = $git->activity->events->getIssue
					($params->get('username'), $params->get('repository'));
				$mapNumber = array();
				foreach ($src as $s) {
					if(in_array($s->issue->number, $mapNumber)) continue;
					array_push($mapNumber, $s->issue->number);
					array_push($out, $s);
				}
				break;
		}
		return $out;
	}
	
	public static function getActivityEvent($params, $type) {
		if($params->get('cache_local') == 1) {
			$cacheFile = self::getFileCache($params, $type);
			$cacheExpiry = $params->get('cache_time_local');
			if((!file_exists($cacheFile)) || ((time() - filemtime($cacheFile)) >= $cacheExpiry)) {
				$out = self::_getActivityEvent($params, $type);
				@file_put_contents($cacheFile, json_encode($out, JSON_UNESCAPED_SLASHES));
			}
		} else $out = self::_getActivityEvent($params, $type);
		if((!isset($out)) || (empty($out))) $out = json_decode(@file_get_contents($cacheFile));
		return $out;
	}
	
	private static function getFileCache($params, $type) {
		$cacheDir = JPATH_SITE.'/cache/mod_ecgithub/';
		if(!is_dir($cacheDir)) @mkdir($cacheDir);
		$cacheFile = $cacheDir.md5($type.'.'.$params->get('repository')).'.json';
		return $cacheFile;
	}
	
	private static function getGithub($params) {
		$regs = new Registry;
		$regs->set('api.username', $params->get('username'));
		$regs->set('api.password', $params->get('password'));
		return new JGithub($regs);
	}
	
	public static function getTimeCache($params, $type) {
		if($params->get('cache_local') == 1) {
			$cacheFile = self::getFileCache($params, $type);
			$time = date('H:i:s', filemtime($cacheFile));
		} else $time = date('H:i:s');
		return $time;
	}
}