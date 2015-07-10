<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcAjax {
	
	public static function focus($id) {
		return '<script type="text/javascript">jQuery("#'.$id.'").focus();</script>';
	}
	
	private static function popoverStrip($id, $title, $content) {
		return 'jQuery("#'.$id.'").popover({
			content: "content", placement: "top", title: "title",
		});';
	}
	
	public static function submit
		($optionCom, $nameKey, $valueKey, $nameCols, $id, $task, $validate) {
		$extra = null;
		
		$validate = ($validate) ? 'true' : 'false';
		
		switch($task) {
			case 'edit': $out = $id; break;
			default: $out = $nameKey.'_'.(int)$valueKey.'_item'; break; }
			
		switch($nameKey) { 
			case 'msglike': $out = $id; break;
			case 'msgcmts': $out = $id; break;
			case 'msgcmt': 
				if($task == 'save') $out = $nameCols[1].'_'.$valueKey.'_'.$nameKey.'s_list';
				if($task == 'delete') { //id: msgcmt_30_msg_1_item: 
					$idArray = explode('_', $id);
					$out = $idArray[2].'_'.$idArray[3].'_'.$nameKey.'s_list';
					$extra .= 'jQuery("#'.$idArray[2].'_'.$idArray[3].'_'.$idArray[0].'s").replaceWith("");'; }
				break; }

		if(empty($nameCols[0])) $jform = '"";';
		else {
			$jform = '{ ';
			foreach($nameCols as $nameCol)
				$jform .= $nameCol.': jQuery("#'.$id.' #jform_'.$nameCol.'").val(), ';
			$jform .= ' };'; }
		return '<script type="text/javascript">
				
			function '.$id.'_'.$task.'() {'.$extra.'
				if('.$validate.') var validate = document.formvalidator.isValid(document.id("'.$id.'"));
				else var validate = true;
				if(validate) { 
					var jform = '.$jform.'
					jQuery.ajax({
						url: "?option='.$optionCom.'&task='.$nameKey.'.'.$task.'",
						method: "POST",
						data: { '.$nameKey.': '.(int)$valueKey.', jform: jform, user: 0 },
						dataType: "html",
						success: function(out) { if(out != "false") jQuery("#'.$out.'").replaceWith(out); }
					}); }
				else { 
					jQuery("#system-message-container").replaceWith
						("<div id=system-message-container style=height:0px;>&nbsp;</div>");
					'.self::popoverStrip($id, "title", "content").' }
			};</script>';
	}
}