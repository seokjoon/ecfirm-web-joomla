<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



$item = $this->item; 
$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
$userConf = JComponentHelper::getParams('com_users');
$availableRegistration = ($userConf->get('allowUserRegistration')) ? true : false;
$urlForm = JRoute::_(JUri::getInstance());
$formId = $nameKey.'_'.$valueKey;
?>



<div id="<?php echo $nameKey; ?>" class="well">
	<form action="<?php echo $urlForm; ?>" method="post" id="<?php echo $formId; ?>" class="form-validate form-horizontal">
	
		<?php if(is_object($this->form)) : ?> 
			<?php foreach ($this->form->getFieldset('login') as $field) : ?>
				<?php if(!($field->hidden)) : ?>
					<div class="control-group">		
						<div class="control-label"><?php echo $field->label; ?></div>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php else : echo $field->input; endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		
		
		
		<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>	
			<div class="control-group">
				<div class="control-label">
					<label><?php echo JText::_('COM_ECUSER_USER_REMEMBER_ME'); ?></label>
				</div>
				<div class="controls">
					<input id="remember" type="checkbox" name="remember" class="inputbox" value="yes" />
				</div>
			</div>
		<?php endif; ?>
		
		
		
		<div class="pull-right clearfix" align="right">
			<div class="btn-group">
				<?php 
				$params = array(
					'optionCom' => $optionCom, 
					'nameKey' => $nameKey, 
					'valueKey' => $valueKey, 
					'task' => 'login', 
					'class' => 'primary',
					'btnType' => 'submit',
					'validate' => true,
				);
				echo EcBtn::submit($params);
				$params['buttonType'] = 'button';
				$params['class'] = 'default';
				$params['task'] = 'registration';
				$params['validate'] = false;
				if(!$availableRegistration) $params['disable'] = true;
				echo EcBtn::submit($params);
				echo EcBtn::caret(true);
				echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
					$params['disable'] = true; //TODO: DELETE ME
					$params['task'] = 'remind';
					echo EcBtn::submitLi($params);
					$params['task'] = 'reset';
					echo EcBtn::submitLi($params);
				echo '</ul>'; ?>
			</div>
		</div><br />
		
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>