<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



/**
 * valueCol: msg value
 * this->items: msgcmts objects
 * optionCom: 'com_ecmsg'
 * nameKey: 'msgcmt'
 * this->form: msgcmtform object
 * nameCol: 'msg'
 * countCol: msg->msgcmt value */
//echo '<br />'.__file__; 
$this->form->setFieldAttribute($nameCol, 'default', $valueCol); //EcDebug::lp($this->form);
$this->form->reset();
$availableTask = (1) ? true : false;
//msg_1_msgcmt_0
echo '<div id="'.$nameKey.'_0_'.$nameCol.'_'.$valueCol.'" style="padding-top: 6px;">';
	//echo '<form action="" method="post" id="" class="form-validate form-vertical">';
	
	foreach($this->form->getFieldset($nameKey) as $field) 
		echo str_replace('<textarea', '<textarea style="width:96%;"', $field->input);
	echo '<input type="hidden" name="task" value="" />';
	echo JHtml::_('form.token');
	
	$params['optionCom'] = $optionCom;
	$params['nameKey'] = $nameKey;
	$params['valueKey'] = 0;
	$params['nameCol'] = 'msg';
	$params['valueCol'] = $valueCol;
	$params['nameCols'] = array($nameKey, 'msg', 'body', 'user');
	$params['task'] = 'save';
	$params['validate'] = true;
	echo EcWidget::submitKey($params);
	
	//echo '</form>';
	
echo '</div>';