<?php 
defined('_JEXEC') or die('Restricted access');



$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$item = $this->item;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
$availableTask = (1) ? true : false; //TODO



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well well-small">';
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical" '
		.'enctype="multipart/form-data">';

		$params['nameCols'] = array();
		if(is_object($this->form)) foreach(($this->form->getFieldset('topic')) as $field) {
			array_push($params['nameCols'], $field->name/* $field->fieldname */);
			echo '<span>'.$field->label.'</span>';
			echo str_replace('<textarea', '<textarea style="width:97%;"', $field->input); 
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
	
		echo '<input type="hidden" name="jform[objcat]" value="'.EcUrl::getObjcat().'" />';
		//echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'" />';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';