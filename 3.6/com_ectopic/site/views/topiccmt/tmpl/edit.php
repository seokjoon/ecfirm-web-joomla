<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$nameCol = $nameKey; //switch
$valueCol = $valueKey;
$nameKey = $nameCol.'cmt';
$valueKey = 0;

$params = array();// ('nameCols' => array()); //only EcAjax
$params['optionCom'] = $optionCom;
$params['nameKey'] = $nameKey;
$params['valueKey'] = $valueKey;
$params['nameCol'] = $nameCol;
$params['valueCol'] = $valueCol;
$params['task'] = 'save';
$params['idPostfix'] = 'form';
$params['post'] = true;
$params['validate'] = false; //use submitform instead of submitbutton



echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
	.$nameKey.'_'.$valueKey.'_'.$nameCol.'_'.$valueCol.'_form" class="form-validate form-horizontal">';
	
	if(is_object($this->topiccmtForm)) {
		foreach ($this->topiccmtForm->getFieldset('topiccmt') as $field) {
			//array_push($params['nameCols'], $field->name); //only EcAjax
			if($field->name == 'jform[body]') {
				$body = ($availableAddCmt) ? str_replace('readonly ', '', $field->input) : $field->input;
				echo str_replace('<textarea', '<textarea style="width: 98%;"', $body);
			} else echo $field->input;
		}
	}
	
	echo '<div style="margin: 10px 0px 30px 0px;"><span style="float:right"><div class="btn-group">';
		echo EcWidget::submitBtn($params); //EcDebug::lp($params);
	echo '</div></span></div>';

	echo '<input type="hidden" name="jform['.$nameCol.']" value="'.$valueCol.'" />';
	echo '<input type="hidden" name="task" value="" />';
	echo JHtml::_('form.token');
echo '</form>'; //EcDebug::lp($params);