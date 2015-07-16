<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$icUser = 'media/com_ec/images/ic_user-48.png';
$item = $this->item;
$nameKey = $this->nameKey;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
$optionCom = JFactory::getApplication()->input->get('option');
$availableTask = (1) ? true : false; //TODO



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well well-small">';
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical">';

		$params['nameCols'] = array();
		if(is_object($this->form)) foreach(($this->form->getFieldset('prod')) as $field) {
			array_push($params['nameCols'], $field->name/* $field->fieldname */);
			echo '<span>'.$field->label.'</span>';
			echo str_replace('<textarea', '<textarea style="width:97%;"', $field->input); }
			
		echo '<span style="float:right"><div class="btn-group">';//EcDebug::lp($params);
			$params['optionCom'] = $optionCom;
			$params['nameKey'] = $nameKey;
			$params['valueKey'] = $valueKey;
			$params['task'] = 'cancel';
			$params['idPostfix'] = 'form';
			$params['post'] = true;
			echo EcprodWidget::submitBtn($params);
			$params['task'] = 'save';
			$params['validate'] = true;
			echo EcprodWidget::submitBtn($params);
			/* echo EcWidget::btnSubmit($optionCom, $nameKey,
				$valueKey, array('body'), '_form', 'cancel', false, false);
			echo EcWidget::btnSubmit($optionCom, $nameKey,
				$valueKey, array('body', 'user', 'msg'), '_form', 'save', false, true); */
		echo '</div></span>';
		
		//echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'" />';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';