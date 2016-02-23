<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcDebug {
	public static function log($items, $key = '') {
		jimport('joomla.log.log');
		JLog::addLogger(array('text_file' => 'ec.php', ));
		if(is_array($items)) $type = 'array'; elseif (is_object($items)) $type = 'object';
		if(isset($type)) { 
			JLog::add($type, JLog::DEBUG, 'type');
			foreach ($items as $key=>$item) {
				if((is_array($item)) || is_object($item)) $item = 'array or object';
				JLog::add($item, JLog::DEBUG, $key); 
			} 
		}
		else JLog::add($items, JLog::DEBUG, $key);
	}
	
	public static function lp($value = null, $call = null)	{
		if(!empty($call)) echo '<br />'.$call;//__method__;
		if(empty($value)) $value = $GLOBALS;
		echo '<pre>'.print_r($value, 1).'</pre>';
	}
}