<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$item = $this->item;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
$availableTask = (1) ? true : false; //TODO



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well well-small form-horizontal">';
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-horizontal" '
		.'enctype="multipart/form-data">';

		$params['nameCols'] = array();
	
		if(is_object($this->form)) {
			foreach(($this->form->getFieldset('topic')) as $field) {
				array_push($params['nameCols'], $field->name);
				if(!($field->hidden)) {
					echo '<div class="control-group">';
						echo '<div class="control-label">'.$field->label.'</div>';
						echo '<div class="controls">'.$field->input.'</div>';
					echo '</div>';
				}
			}
			foreach(($this->form->getFieldset('body')) as $field) {
				array_push($params['nameCols'], $field->name);
					echo $field->label;
					echo '<div>'.$field->input.'</div>';//echo str_replace('<textarea', '<textarea style="width:97%;"', $field->input);
			}
			foreach(($this->form->getFieldset('file')) as $field) {
				array_push($params['nameCols'], $field->name);
				if(!($field->hidden)) {
					echo '<div class="control-group">';
						echo '<div class="control-label">'.$field->label.'</div>';
						echo '<div class="controls">'.$field->input.'</div>';
					echo '</div>';
				}
			}
			foreach(($this->form->getFieldset('topic')) as $field) {
				if($field->hidden) {
					array_push($params['nameCols'], $field->name);
					echo $field->input;
				}
			}
		}
		
		echo '<span style="float:right"><div class="btn-group">';//EcDebug::lp($params);
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
	
		echo '<input type="hidden" name="jform[topiccat]" value="'.EctopicUrl::getTopiccat().'" />';
		//echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'" />';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';