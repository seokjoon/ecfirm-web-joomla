<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcWidget {
	
	public static function caretBtn($link = false) {
		$class = ($link) ? ' btn-default ' : ' btn-link ';
		return '<button type="button" class="btn'.$class.'dropdown-toggle" '
			.'data-toggle="dropdown"><span class="caret"></span></button>';
	}
	
	/**
	 * @param array $params: optionCom, nameKey, valueKey, task */
	public static function confirmModal($params) {
		extract($params);
		$id = $nameKey.'_'.$valueKey;
		$out = '<div id="'.$id.'">';
		$id .= '_confirm';
		$paramsCancel = $params;
		$paramsCancel['task'] = 'cancel';
		$paramsConfirm = $params;
		$paramsConfirm['task'] = $task;
		$out .= '<script>jQuery("#'.$id.'").modal({ backdrop: false, keyboard: false });</script>';
		$out .= '<div id="'.$id.'" class="modal hide fade" tabindex="-1" role="dialog" 
			style="position: static; margin-left: 0; width: 100%;" 
			aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog"><div class="modal-content">
				<div class="modal-header">
					<h3 id="modalLabel" class="modal-title">'
						.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</h3>
				</div>
				<div class="modal-body"><div>
					<div id="test" class="pull-left">&#160;'.'&#160;</div>
				</div></div>
				<div class="modal-footer">'
					.self::submitBtn($paramsCancel)
					.self::submitBtn($paramsConfirm)
				.'</div>
			</div></div></div>';
		$out .= '</div>';
		return $out;
	}//<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	
	/**
	 * @param array $params: optionCom, nameKey, valueKey, task */
	public static function confirmModalSingle($params) {
		extract($params);
		$id = $nameKey.'_'.$valueKey;
		$out = '<div id="'.$id.'">';
		$id .= '_confirm';
		$paramsCancel = $params;
		$paramsCancel['task'] = 'cancel';
		$out .= '<script>jQuery("#'.$id.'").modal({ backdrop: false, keyboard: false });</script>';
		$out .= '<div id="'.$id.'" class="modal hide fade" tabindex="-1" role="dialog" 
			style="position: static; margin-left: 0; width: 100%;" 
			aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog"><div class="modal-content">
				<div class="modal-header">
					<h3 id="modalLabel" class="modal-title">'
						.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</h3>
				</div>
				<div class="modal-body"><div>
					<div id="test" class="pull-left">&#160;'.'&#160;</div>
				</div></div>
				<div class="modal-footer">'
					.self::submitBtn($paramsCancel)
				.'</div>
			</div></div></div>';
		$out .= '</div>';
		return $out;
	}
	
	public static function getIcon($task) {
		switch (TRUE) {
			case preg_match('/^add/', $task): $icon = 'icon-edit'; break;
			case preg_match('/^cancel/', $task): $icon = 'icon-trash'; break;
			case preg_match('/^comment/', $task): $icon = 'icon-comment'; break;
			case preg_match('/^delete/', $task): $icon = 'icon-trash'; break;
			case preg_match('/^edit/', $task): $icon = 'icon-edit'; break;
			case preg_match('/^like/', $task): $icon = 'icon-thumbs-up'; break;
			case preg_match('/^log/', $task): $icon = 'icon-chevron-right'; break;
			case preg_match('/^option/', $task): $icon = 'icon-cog'; break;
			case preg_match('/^save/', $task): $icon = 'icon-edit'; break;
			case preg_match('/^share/', $task): $icon = 'icon-share'; break;
			case preg_match('/^touch/', $task): $icon = 'icon-chevron-up'; break;
			default: $icon = ''; break; 
		}
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
	 * @param array $params: optionCom, nameKey, nameCol, valueCol, nameCols, 
	 * task, countKey */
	public static function cmtSpan($params) {
		extract($params);
		$id = $nameCol.'_'.(int)$valueCol.'_'.$nameKey;
		$out = '<span id="'.$id.'">&#160;';
		if($task == 'show') $out .= '<script>jQuery("#'.$nameCol.'_'.$valueCol
			.'_'.$nameKey.'_list").replaceWith("");</script>';
		$params['id'] = $id;
		$params['validate'] = false;
		$params['valueKey'] = 0;		
		$out .= EcAjax::submit($params);
		$icon = '<span class="'.self::getIcon('comment').'"></span>';
		$text = $countKey.'&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task);
		$input = '<input type="hidden" id="jform_'.$nameCol.'" value="'.$valueCol.'" />';
		$click = ' onClick="'.$id.'_'.$task.'()" ';
		$out .= '<a href="javascript:;"'.$click.' style="text-decoration: none;">'
			.$icon.$text.$input.'</a>&#160;</span>'; 
		return $out;
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
		$id = $nameKey.'_'.(int)$valueKey;
		if(isset($nameCol)) $id = $id.'_'.$nameCol.'_'.(int)$valueCol;
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
	
	/**
	 * @param array $params: optionCom, nameKey, valueKey, nameCol, valueCol, 
	 * nameCols, task, validate */
	public static function submitKey($params) {
		extract($params);
		$id = $nameKey.'_'.$valueKey.'_'.$nameCol.'_'.$valueCol; //valueKey == 0
		$params['id'] = $id;
		$out = EcAjax::submit($params);
		$out .= '<script type="text/javascript">
			jQuery("#'.$id.' #jform_body").keydown(function(key) {
				if((key.keyCode == 13)) {
					jQuery("#'.$nameCol.'_'.$valueCol.'_'.$nameKey.'s").replaceWith("");
					'.$id.'_'.$task.'(); } }); </script>';
		return $out;
	}
	
	/**
	 * @param array $params: optionCom, nameKey, valueKey, task, post, validate */
	public static function submitTextarea($params) {
		extract($params);
		$id = $nameKey.'_'.$valueKey; //valueKey == 0
		$params['id'] = $id;
		$click = ($post) ? ' onClick="Joomla.submitform(\''.$nameKey.'.'.$task
			.'\', document.getElementById(\''.$id.'\'))" ' : ' onClick="'.$id.'_'.$task.'()" ';
		$out = ($post) ? EcWidget::getSubmitbutton($id) : EcAjax::submit($params);
		$out .= '<textarea '.$click.' style="width:96%" rows="2" placeholder="'
			.JText::_($optionCom.'_'.$nameKey.'_'.$task).'"></textarea>';
		return $out;
	}
}