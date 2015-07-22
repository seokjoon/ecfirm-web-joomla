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
		if(($availableTask) && ($task == 'edit')) echo EcmsgWidget::btnSubmit
			($optionCom, $this->nameKey, $valueKey, array('body'), '_form', 'cancel', false, false);
		else if(($availableTask) && ($task == 'add')) echo EcmsgWidget::btnSubmit
			($optionCom, $this->nameKey, $valueKey, array(''), '', 'addPre', false, false); 
		echo EcmsgWidget::btnSubmit($optionCom, $this->nameKey, 
			$valueKey, array('body', 'user', 'msg'), '_form', 'save', false, true);
		echo '</div></span>';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';