<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$valueKey = $topiccmt->$nameKey;
$topiccmtUsername = $topiccmt->username;
$topiccmtBody = nl2br($topiccmt->body);
$topiccmtModified = $topiccmt->modified;



echo '<form action="'.JRoute::_(JUri::getInstance()).'" method="post" id="'
	.$nameKey.'_'.$valueKey.'_'.$nameCol.'_'.$valueCol.'_form" class="form-validate form-horizontal">';

echo '<div style="margin: 10px 0px 10px 0px;">';
	echo '<div class="pull-left" style="width:95%;">';
		echo '<div style="padding: 0px 0px 5px 20px;">'.$topiccmtModified.$seperator.$topiccmtUsername.'</div>';
		echo '<div style="border: solid 1px #dddddd; padding: 10px;">'.$topiccmtBody.'</div>';
	echo '</div>';	
	
	echo '<div class="pull-right" style="width:5%" align="right">';
		echo '<div class="btn-group">';
			echo EcWidget::caretBtn(false);
			echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
				if($availableDelete) {
					$params = array();// ('nameCols' => array()); //only EcAjax
					$params['optionCom'] = $optionCom; 
					$params['nameKey'] = $nameKey;
					$params['valueKey'] = $valueKey;
					$params['nameCol'] = $nameCol;
					$params['valueCol'] = $valueCol;
					//$params['nameCols'] = array($nameKey, $nameCol, 'user');  //only EcAjax
					$params['task'] = 'delete';
					$params['idPostfix'] = 'form';
					$params['post'] = true;
					$params['validate'] = false;
					echo EcWidget::submitBtnLi($params);
				}
			echo '</ul>';
		echo '</div>';
	echo '</div>';
	
	echo '<input type="hidden" name="jform['.$nameKey.']" value="'.$valueKey.'" />';
	echo '<input type="hidden" name="jform['.$nameCol.']" value="'.$valueCol.'" />';
	echo '<input type="hidden" name="jform[user]" value="0" />';
	//echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'" />';
	//echo '<input type="hidden" name="'.$nameCol.'" value="'.$valueCol.'" />';
	//echo '<input type="hidden" name="user" value="0" />';
	echo '<input type="hidden" name="task" value="" />';
	echo JHtml::_('form.token');
	
echo '</div><div class="clearfix"></div>'; 

echo '</form>'; //EcDebug::lp($params);