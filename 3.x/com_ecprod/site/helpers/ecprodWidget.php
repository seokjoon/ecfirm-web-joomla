<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcprodWidget {
	
	/**
	 * @param array $params
	 * - essential: optionCom, nameKey, valueKey, task
	 * - optional: nameCol, valueCol, nameCols, idPostfix, post, validate, li */
	public static function submitBtn($params) { //EcDebug::log($params);
		extract($params);
		$icon = EcWidget::getIcon($task);
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
		$out = ($post) ? EcWidget::getSubmitbutton($id) : EcprodAjax::submit($params);
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
	
	public static function spanReadmore() { }

}