<?php /** @package iruseum.com
* @copyright	Copyright (C) iruseum.com. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

$item = $this->item; 
$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
$userConf = JComponentHelper::getParams('com_users');
$availableRegistration = ($userConf->get('allowUserRegistration')) ? true : false;



echo '<div id="'.$nameKey.'" class="well">';
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'" class="form-validate form-horizontal">';
	
		if(is_object($this->form)) { //EcDebug::lp($this->form);
			foreach($this->form->getFieldset('login') as $field) {
				echo '<div class="control-group">';
					echo '<div class="control-label">'.$field->label.'</div>';
					echo '<div class="controls">'.$field->input.'</div>';
				echo '</div>';
			} 
		}
		
		/* if(JPluginHelper::isEnabled('system', 'remember')) {
			echo '<div class="control-group">';
				echo '<div class="control-label"><label>'
					.JText::_('COM_ECUSER_LOGIN_REMEMBER_ME').'</label></div>'; 
				echo '<div class="controls"><input id="remember" type="checkbox" '
					.'name="remember" class="inputbox" value="yes" /></div>';
			echo '</div>';
		} */
		
		echo '<div class="pull-right clearfix" align="right">';
			echo '<div class="btn-group">';
				$params = array('optionCom' => $optionCom, 'nameKey' => $nameKey, 
					'valueKey' => $valueKey, 'task' => 'login', 'class' => 'primary', 'btnType' => 'submit');
				echo EcBtn::submit($params);
				if($availableRegistration) {
					$params['buttonType'] = 'button';
					$params['class'] = 'default';
					$params['task'] = 'registration';
					echo EcBtn::submit($params);
					echo EcBtn::caret(true);
					echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
						$params['disable'] = true;
						$params['task'] = 'remind';
						echo EcBtn::submitLi($params);
						$params['task'] = 'reset';
						echo EcBtn::submitLi($params);
					echo '</ul>';
				}
			echo '</div>';
		echo '</div><br />'; //EcDebug::lp($params);
		
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';