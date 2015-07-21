<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcWidget {
	
	public static function caretBtn($link = false) {
		$class = ($link) ? ' btn-default ' : ' btn-link ';
		return '<button type="button" class="btn'.$class.'dropdown-toggle" '
			.'data-toggle="dropdown"><span class="caret"></span></button>';
	}
	
	/**
	 * @deprecated TODO
	 * @param array $params
	 * - essential: 
	 * - optional: */
	public static function confirmModal($params) {
		extract($params);
		
	}
	
	public static function getIcon($task) {
		switch ($task) {
			case 'add': $icon = 'icon-edit'; break;
			case 'addPre': $icon = 'icon-trash'; break;
			case 'cancel': $icon = 'icon-trash'; break;
			case 'comment': $icon = 'icon-comment'; break;
			case 'delete': $icon = 'icon-trash'; break;
			case 'edit': $icon = 'icon-edit'; break;
			case 'like': $icon = 'icon-thumbs-up'; break;
			case 'option': $icon = 'icon-cog'; break;
			case 'save': $icon = 'icon-edit'; break;
			case 'saveImg': $icon = 'icon-edit'; break;
			case 'share': $icon = 'icon-share'; break;
			default: $icon = ''; break; }
		return $icon;
	}	
	
	public static function getSubmitbutton($id) {
		return '<script type="text/javascript">
			Joomla.submitbutton = function(task) {
				if(document.formvalidator.isValid(document.id("'.$id.'"))){'
				.'Joomla.submitform(task, document.getElementById("'.$id.'")); } } 
			</script>';
	}
	
	/**
	 * @param array $params: optionCom, nameKey, valueKey, nameCol, valueCol, 
	 * nameCols, task, countKey */
	public static function likeSpan($params) {
		extract($params);
		$id = $nameCol.'_'.(int)$valueCol.'_'.$nameKey.'_'.(int)$valueKey;
		$params['id'] = $id;
		$params['validate'] = false;
		$out = '<span id="'.$id.'">&#160;'.EcAjax::submit($params);
		$click = ' onClick="'.$id.'_'.$task.'()'.'" ';
		$icon = '<span class="'.self::getIcon('like').'"></span>';
		$text = $countKey.'&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task);
		$input = '<input type="hidden" id="jform_'.$nameCol.'" value="'.$valueCol.'" />';
		$out .= '<a href="javascript:;"'.$click.' style="text-decoration: none;">'
			.$icon.$text.$input.'</a>&#160;</span>';
		return $out;
	}
	
	public static function readmoreSpan() { }
	
	/**
	 * @param array $params
	 * - essential: optionCom, nameKey, valueKey, task
	 * - optional: nameCol, valueCol, nameCols, idPostfix, post, validate, li */
	public static function submitBtn($params) { //EcDebug::log($params);
		extract($params);
		$icon = self::getIcon($task);
		$id = $nameKey.'_'.$valueKey;
		if(isset($nameCol)) $id = $id.'_'.$nameCol.'_'.$valueCol;
		if(isset($idPostfix)) $id = $id.'_'.$idPostfix;
		if(!(isset($post))) $post = false;
		if(!(isset($validate))) $validate = false;
		if(!(isset($li))) $li = false;
		$params['id'] = $id;
		$params['validate'] = $validate;
		$submitbutton = ($validate) ? 'submitbutton' : 'submitform';
		$class = ($validate) ? ' btn-primary validate ' : ' btn-default ';
		$click = ($post) ? ' onClick="Joomla.'.$submitbutton.'(\''.$nameKey.'.'.$task
			.'\', document.getElementById(\''.$id.'\'))" ' : ' onClick="'.$id.'_'.$task.'()" ';	
		$out = ($post) ? self::getSubmitbutton($id) : EcAjax::submit($params);
		if($li) $out .= '<li><a href="javascript:;"'.$click.'><span class="'.$icon.'">&#160;'
			.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</span></a></li>';
		else $out .= '<button type="button" class="btn'.$class.'" '.$click.'><span class="'
			.$icon.'"></span>&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</button>';
		return $out;
	}
	
	public static function submitBtnLi($params) { 
		$params['li'] = true;
		return self::submitBtn($params);
	}
	
}