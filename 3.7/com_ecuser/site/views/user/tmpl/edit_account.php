<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

$item = $this->item; 
$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well">';
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-horizontal">';
		
		if(is_object($this->form)) { //EcDebug::lp($this->form);
			foreach($this->form->getFieldset('account') as $field) {
				if($field->hidden) echo $field->input;
				else {
					echo '<div class="control-group">';
						echo '<div class="control-label">'.$field->label.'</div>';
						echo '<div class="controls">'.$field->input.'</div>';
					echo '</div>';
				}
			} 
		}

		echo '<div class="pull-right clearfix" align="right" >';
			echo '<div class="btn-group">';
				$params = array('optionCom' => $optionCom, 'nameKey' => $nameKey, 
					'valueKey' => $valueKey, 'task' => 'save', 'idPostfix' => 'form',
					'class' => 'primary', 'btnType' => 'submit');
				echo EcBtn::submit($params);
				$params['btnType'] = 'button';
				$params['class'] = 'default';
				$params['task'] = 'cancel';
				echo EcBtn::submit($params);
			echo '</div>';
		echo '</div><br />'; //EcDebug::lp($params);
		
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';