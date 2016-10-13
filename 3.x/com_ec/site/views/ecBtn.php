<?php 
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcBtn {

	public static function caret($link = false) {
		$class = ($link) ? ' btn-default ' : ' btn-link ';
		return '<button type="button" class="btn'.$class.'dropdown-toggle" '
			.'data-toggle="dropdown"><span class="caret"></span></button>';
	}

	private static function icon($task) {
		switch (TRUE) {
			case preg_match('/^add/', $task): $icon = 'icon-edit'; break;
			case preg_match('/^cancel/', $task): $icon = 'icon-trash'; break;
			case preg_match('/^comment/', $task): $icon = 'icon-comment'; break;
			case preg_match('/^delete/', $task): $icon = 'icon-trash'; break;
			case preg_match('/^edit/', $task): $icon = 'icon-edit'; break;
			case preg_match('/^like/', $task): $icon = 'icon-thumbs-up'; break;
			case preg_match('/^log/', $task): $icon = 'icon-chevron-right'; break;
			case preg_match('/^option/', $task): $icon = 'icon-cog'; break;
			case preg_match('/^regist/', $task): $icon = 'icon-edit'; break;
			case preg_match('/^save/', $task): $icon = 'icon-edit'; break;
			case preg_match('/^share/', $task): $icon = 'icon-share'; break;
			case preg_match('/^touch/', $task): $icon = 'icon-chevron-up'; break;
			default: $icon = ''; break;
		}
		return $icon;
	}

	private static function joomlaSubmit($id) {
		return '<script type="text/javascript">
			Joomla.submitbutton = function(task) {
				if(document.formvalidator.isValid(document.id("'.$id.'"))){'
					.'Joomla.submitform(task, document.getElementById("'.$id.'")); } } 
		</script>';
	}

	public static function link($params = array()) {

	}

	/**
	 * @param array $params
	 * - essential: optionCom, nameKey, task
	 * - optional: valueKey, nameCol, valueCol, nameCols, idPostfix, ajax, validate, li, class, disable */
	public static function submit($params = array()) { //EcDebug::lp($params); 
		extract($params);
		$icon = self::icon($task);
		if(!isset($valueKey)) $valueKey = 0;
		$id = $nameKey.'_'.(int)$valueKey;
		if(isset($nameCol)) $id .= '_'.$nameCol.'_'.(int)$valueCol;
		if(isset($idPostfix)) $id .= '_'.$idPostfix;
		if(!(isset($ajax))) $ajax = false; //!ajax == post
		if(!(isset($validate))) $validate = false;
		if(!(isset($li))) $li = false;
		if(!(isset($btnType))) $btnType = 'button';
		if(!(isset($class))) $class = 'default';
		$class = ' btn-'.$class;
		$class .= ($validate) ? ' validate' : null;
		$classLi = ((isset($disable)) && ($disable)) ? 'disabled' : null;
		$disable = ((isset($disable)) && ($disable)) ? ' disabled="disabled"' : null;
		$submitbutton = ($validate) ? 'submitbutton' : 'submitform';
		$click = ($ajax) ? ' onClick="'.$id.'_'.$task.'()" ' 
			: ' onClick="Joomla.'.$submitbutton.'(\''.$nameKey.'.'.$task.'\', document.getElementById(\''.$id.'\'))" ';
		$click = ($disable) ? null : $click;
		$out = ($ajax) ? EcAjax::submit($params) : self::joomlaSubmit($id);
		if($li) $out .= '<li class="'.$classLi.'"><a href="javascript:;"'.$click.'><span class="'
			.$icon.'">&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</span></a></li>';
		else $out .= '<button type="'.$btnType.'" class="btn'.$class.'" '.$click.$disable.'><span class="'
			.$icon.'"></span>&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</button>';
		return $out;
	}

	public static function submitLi($params = array()) { 
		$params['li'] = true;
		return self::submit($params);
	}
}