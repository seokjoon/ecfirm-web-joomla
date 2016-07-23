<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



/**
 * @deprecated */
class EcAjax {
	
	public static function focus($id) {
		return '<script type="text/javascript">jQuery("#'.$id.'").focus();</script>';
	}
	
	public static function popoverStrip($id, $title, $content) {
		return 'jQuery("#'.$id.'").popover({
			content: "'.$content.'", placement: "top", title: "'.$title.'",
		});';
	}
	
	/** 
	 * @param array $params: optionCom, nameKey, valueKey, nameCol, valueCol, 
	 * nameCols, task, idPostfix, post, validate, li, id */
	public static function submit($params) {
		extract($params); //EcDebug::lp($params);	
		$extra = null;
		$validate = ($validate) ? 'true' : 'false';
		
		switch($nameKey) { //@TODO
			case 'msg' : case 'topic' : case 'notice' : case 'faq' :
				switch($task) {
					case 'cancel' :
					case 'save' : $out = $nameKey.'_'.(int)$valueKey; break;
					default : $out = $id; break; 
				} 
				break;
			case 'msgcmt' : case 'topiccmt' : case 'noticecmt' : case 'faqcmt' :
				switch($task) {
					case 'delete' : 
						$extra .= 'jQuery("#'.$nameCol.'_'.$valueCol.'_'.$nameKey.'s").replaceWith("");';
						$out = $nameCol.'_'.$valueCol.'_'.$nameKey.'s_list';
						break; //msgcmt_n_msg_n
					case 'save' : $out = $nameCol.'_'.$valueCol.'_'.$nameKey.'s_list';
						break;//msg_n_msgcmts_list
					default : $out = $id; break; 
				}
				break;
			default : $out = $id; break; 
		}
		
		if(isset($nameCols)) {
			$jform = '{ ';
			foreach($nameCols as $col)
				$jform .= $col.': jQuery("#'.$id.' #jform_'.$col.'").val(), ';
			$jform .= ' };'; 
		} else $jform = '"";';
		
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
					'.self::popoverStrip($id, "title 1", "content 1").' }
			};</script>';
	}
}