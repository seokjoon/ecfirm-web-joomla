<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$optionCom = $this->optionCom;



$valueKey = (isset($valueKey)) ? $valueKey : 0;
echo '<div id="'.$this->nameKey.'_'.$valueKey.'_body" class="tab-pane active">';
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$this->nameKey.'_'.$valueKey.'_body_form" class="form-validate form-vertical">';
		foreach ($this->form->getFieldset('msg') as $field) {
			echo '<span style="display:none;">'.$field->label.'</span>';
			echo str_replace('<textarea', '<textarea style="width:96%;"', $field->input); }
		echo '<span style="float:right"><div class="btn-group">';
			$params['optionCom'] = $optionCom;
			$params['nameKey'] = $this->nameKey;
			$params['valueKey'] = $valueKey;
			$params['nameCols'] = array('body');
			$params['task'] = 'cancel';
			$params['idPostfix'] = 'body_form';
			$params['post'] = false;
			$params['validate'] = false;
			if(($availableTask) && ($task == 'edit')) 
				echo EcWidget::submitBtn($params);
			else if(($availableTask) && ($task == 'add')) {
				$params['nameCols'] = array();
				$params['task'] = 'addPre'; 
				$params['idPostfix'] = null;
				echo EcWidget::submitBtn($params); }
			$params['nameCols'] = array('body', 'user', 'msg', 'img');//('body', 'user', 'msg');
			$params['task'] = 'save';
			$params['idPostfix'] = 'body_form';
			$params['validate'] = true;
			echo EcWidget::submitBtn($params);
		echo '</div></span>';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';