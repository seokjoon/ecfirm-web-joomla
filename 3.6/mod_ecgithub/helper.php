<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
//use Joomla\Github\Github;
use Joomla\Registry\Registry;



class ModEcgithubHelper {
	
	public static function getActivityEvent($params, $type) {
		if($params->get('cache_local') == 1) {
			$cacheDir = JPATH_SITE.'/cache/mod_ecgithub/';
			if(!is_dir($cacheDir)) @mkdir($cacheDir);
			$cacheFile = $cacheDir.md5(__method__.'.'.$type.'.'.$params->get('repository')).'.json'; 
			$cacheExpiry = $params->get('cache_time_local');
			if((!file_exists($cacheFile)) || ((time() - filemtime($cacheFile)) >= $cacheExpiry)) {
				$git = self::getGithub($params);
				switch ($type) {
					case 'commits' :
					case 'default' :
						$out = $git->activity->events->getRepository
							($params->get('username'), $params->get('repository'));
						break;
					case 'issues':
						$out = $git->activity->events->getIssue
							($params->get('username'), $params->get('repository'));
						break;
				}
			}
		} 
		if((!isset($out)) || (empty($out))) $out = json_decode(file_get_contents($cacheFile));
		else @file_put_contents($cacheFile, json_encode($out, JSON_UNESCAPED_SLASHES));
		return $out;
	}
	
	private static function getGithub($params) {
		$regs = new Registry;
		$regs->set('api.username', $params->get('username'));
		$regs->set('api.password', $params->get('password'));
		return new JGithub($regs);
	}
}