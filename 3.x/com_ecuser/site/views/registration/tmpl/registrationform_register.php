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
$app = JFactory::getApplication(); //EcDebug::lp($app->get('captcha'));
$availableCaptcha = (empty($app->get('captcha'))) ? false : true;
$urlForm = JRoute::_(JUri::getInstance());
$formId = $nameKey . '_' . $valueKey;
?>



<div id="<?php echo $nameKey; ?>" class="well">
	<form action="<?php echo $urlForm; ?>" method="post" id="<?php echo $formId; ?>" class="form-validate form-horizontal">

	<?php if(is_object($this->form)) : ?> 
	
		<?php foreach ($this->form->getFieldset('registration') as $field) : ?>
			<?php if(!($field->hidden)) : ?>
			<div class="control-group">		
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>
			</div>
			<?php else : echo $field->input; endif; ?>
		<?php endforeach; ?>
		
		<?php if($availableCaptcha) : ?>
			<?php foreach ($this->form->getFieldset('captcha') as $field) : ?>
			<div class="control-group">
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>
			</div>	
			<?php endforeach; ?>
		<?php endif; ?>
		
	<?php endif; ?>
	
		<div class="pull-right clearfix" align="right">
			<div class="btn-group">
			<?php 
			$params = array(
				'optionCom' => $optionCom, 
				'nameKey' => $nameKey, 
				'valueKey' => $valueKey, 
				'task' => 'register', 
				'class' => 'primary', 
				'btnType' => 'submit',
				'validate' => true,
			);
			echo EcBtn::submit($params);
			$params['btnType'] = 'button';
			$params['class'] = 'default';
			$params['task'] = 'login';
			$params['validate'] = false;
			echo EcBtn::submit($params); 
			echo EcBtn::caret(true);
			echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
				$params['disable'] = true; //DELETE ME
				$params['task'] = 'remind';
				echo EcBtn::submitLi($params);
				$params['task'] = 'reset';
				echo EcBtn::submitLi($params);
			echo '</ul>';
			?>
			</div>
		</div><br />
	
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	
	</form>
</div>