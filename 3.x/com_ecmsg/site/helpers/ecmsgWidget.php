<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgWidget {

	/**
	 * @deprecated TODO */
	public static function btnLiSubmit
		($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, $post) {
		$icon = EcWidget::getIcon($task);
		$id = $nameKey.'_'.$valueKey.'_'.$nameCols[0].$id;
		$click = ($post) ? ' onClick="Joomla.submitform(\''.$nameKey.'.'.$task
			.'\', document.getElementById(\''.$id.'\'))" ' : ' onClick="'.$id.'_'.$task.'()" ';
		$out = ($post) ? '' : EcmsgAjax::submit
			($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, false);
		$out .= '<li><a href="javascript:;"'.$click.'><span class="'.$icon.'">&#160;'
			.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</span></a></li>';
		return $out;
	}

	/**
	 * @deprecated TODO */
	public static function btnSubmit
		($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, $post, $validate) {
		$icon = EcWidget::getIcon($task);
		$id = $nameKey.'_'.$valueKey.'_'.$nameCols[0].$id; 
		$submitbutton = ($validate) ? 'submitbutton' : 'submitform';
		$class = ($validate) ? ' btn-primary validate ' : ' btn-default ';
		$click = ($post) ? ' onClick="Joomla.'.$submitbutton.'(\''.$nameKey.'.'.$task
			.'\', document.getElementById(\''.$id.'\'))" ' : ' onClick="'.$id.'_'.$task.'()" ';
		$out = ($post) ? EcWidget::getSubmitbutton($id) : EcmsgAjax::submit
			($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, $validate);
		$out .= '<button type="button" class="btn'.$class.'" '.$click.'><span class="'
			.$icon.'"></span>&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task).'</button>';
		return $out;
	}
	
	/**
	 * @deprecated TODO */
	public static function keySubmit
		($optionCom, $nameKey, $valueCol, $nameCols, $id, $task, $validate) {
		//$id = (empty($id)) ? $nameCols[1].'_'.$valueCol.'_'.$nameKey.'_0' : $id;
		$id = (empty($id)) ? $nameKey.'_0_'.$nameCols[1].'_'.$valueCol : $id;
		$out = EcmsgAjax::submit($optionCom, $nameKey, $valueCol, $nameCols, $id, $task, $validate);
		$out .= '<script type="text/javascript">
			jQuery("#'.$id.' #jform_body").keydown(function(key) {
				if((key.keyCode == 13)) {
					jQuery("#'.$nameCols[1].'_'.$valueCol.'_'.$nameKey.'s").replaceWith("");
					'.$id.'_'.$task.'();
				}
			});
		</script>';
		return $out;
	}

	/**
	 * @deprecated TODO */
	public static function modalConfirm
		($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, $post) {
		$idOrg = $id;
		$id = $nameKey.'_'.$valueKey.'_'.$nameCols[0].$id;
		$out = '<div id="'.$id.'">';
		$id .= '_confirm';
		$out .= '<script>jQuery("#'.$id.'")
			.modal({ backdrop: false, keyboard: false });</script>';
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
					.self::btnSubmit($optionCom, $nameKey, $valueKey, $nameCols, $idOrg, 'cancel', $post, false)
					.self::btnSubmit($optionCom, $nameKey, $valueKey, $nameCols, $idOrg, $task, $post, false)
				.'</div>
			</div></div></div>';
		$out .= '</div>';
		return $out;
	} //<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

	/**
	 * @deprecated TODO */
	public static function spanCmt
		($optionCom, $nameKey, $nameCols, $valueCol, $task, $countKey) {
		//msg_55_msgcmt_list
		$id = $nameCols[0].'_'.(int)$valueCol.'_'.$nameKey;
		$click = ' onClick="'.$id.'_'.$task.'()" ';
		$out = '<span id="'.$id.'">&#160;';
		if($task == 'show') $out .= '<script>jQuery("#'.$nameCols[0].'_'.$valueCol
			.'_'.$nameKey.'_list").replaceWith("");</script>';
		$out .= EcmsgAjax::submit
			($optionCom, $nameKey, 0, $nameCols, $id, $task, false);
		$icon = '<span class="'.EcWidget::getIcon('comment').'"></span>';
		$text = $countKey.'&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task);
		$input = '<input type="hidden" id="jform_msg" value="'.$valueCol.'" />';
		$out .= '<a href="javascript:;"'.$click.' style="text-decoration: none;">'
			.$icon.$text.$input.'</a>';
		$out .= '&#160;</span>';
		return $out;
	}

	/**
	 * @deprecated TODO */
	public static function spanLike
		($optionCom, $nameKey, $valueKey, $nameCols, $valueCol, $task, $countKey) {
		//$id = $nameKey.'_'.(int)$valueKey;
		$id = $nameCols[0].'_'.(int)$valueCol.'_'.$nameKey.'_'.(int)$valueKey;
		$click = ' onClick="'.$id.'_'.$task.'()'.'" ';
		$out = '<span id="'.$id.'">&#160;';
		$out .= EcmsgAjax::submit
			($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, false);
		$icon = '<span class="'.EcWidget::getIcon('like').'"></span>';
		$text = $countKey.'&#160;'.JText::_($optionCom.'_'.$nameKey.'_'.$task);
		$input = '<input type="hidden" id="jform_msg" value="'.$valueCol.'" />';
		$out .= '<a href="javascript:;"'.$click.' style="text-decoration: none;">'
			.$icon.$text.$input.'</a>';
		$out .= '&#160;</span>';
		return $out;
	}

	/**
	 * @deprecated TODO */
	public static function spanReadmore() { }
	
	/**
	 * @deprecated TODO */
	public static function textareaSubmit
		($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, $post, $validate) {
		$id = $nameKey.'_'.$valueKey.'_'.$nameCols[0].$id;
		$click = ($post) ? ' onClick="Joomla.submitform(\''.$nameKey.'.'.$task
			.'\', document.getElementById(\''.$id.'\'))" ' : ' onClick="'.$id.'_'.$task.'()" ';
		$out = ($post) ? EcWidget::getSubmitbutton($id) : 
			EcmsgAjax::submit($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, false);
		$out .= '<textarea '.$click.' style="width:96%" rows="2" placeholder="'
			.JText::_($optionCom.'_'.$nameKey.'_'.$task).'"></textarea>';
		return $out;
	}
}