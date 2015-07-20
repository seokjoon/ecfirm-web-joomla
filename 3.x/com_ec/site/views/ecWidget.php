<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcWidget {
	
	/**
	 * @param array $params
	 * - essential: 
	 * - optional: */
	public static function confirmModal($params) {
		extract($params);
		
		
	}
	
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
	
}