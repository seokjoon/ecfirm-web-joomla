<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$item = $this->item;
$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
$availableTask = (1) ? true : false; //TODO



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well well-small">';
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical">';
		
		$params['nameCols'] = array();
		if(is_object($this->form)) { 
			foreach($this->form->getFieldset('profile') as $field) {
				array_push($params['nameCols'], $field->name);
				echo $field->label;
				echo $field->input; } }

		echo '<span style="float:right"><div class="btn-group">';
			$params['optionCom'] = $optionCom;
			$params['nameKey'] = $nameKey;
			$params['valueKey'] = $valueKey;
			$params['task'] = 'cancel';
			$params['idPostfix'] = 'form';
			$params['post'] = true;
			echo EcWidget::submitBtn($params);
			$params['task'] = 'save';
			$params['validate'] = true;
			echo EcWidget::submitBtn($params);
		echo '</div></span>';
		
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';