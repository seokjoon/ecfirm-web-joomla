<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



/**
 * valueCol: topic value
 * this->items: topiccmts objects
 * optionCom: 'com_ectopic'
 * nameKey: 'topiccmt'
 * this->form: topiccmtform object
 * nameCol: 'topic'
 * countCol: topic->topiccmt value */
//echo '<br />'.__file__; 
$this->form->setFieldAttribute($nameCol, 'default', $valueCol); //EcDebug::lp($this->form);
$this->form->reset();
$availableTask = (1) ? true : false;
//topic_1_topiccmt_0
echo '<div id="'.$nameKey.'_0_'.$nameCol.'_'.$valueCol.'" style="padding-top: 6px;">';
	//echo '<form action="" method="post" id="" class="form-validate form-vertical">';
	
	foreach($this->form->getFieldset($nameKey) as $field) 
		echo str_replace('<textarea', '<textarea style="width:96%;"', $field->input);
	echo '<input type="hidden" name="task" value="" />';
	echo JHtml::_('form.token');
	
	$params['optionCom'] = $optionCom;
	$params['nameKey'] = $nameKey;
	$params['valueKey'] = 0;
	$params['nameCol'] = 'topic';
	$params['valueCol'] = $valueCol;
	$params['nameCols'] = array($nameKey, 'topic', 'body', 'user');
	$params['task'] = 'save';
	$params['validate'] = true;
	echo EcWidget::submitKey($params);
	
	//echo '</form>';
	
echo '</div>';