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

$urlForm = JUri::getInstance()->toString();
$formId = $nameKey . '_' . $valueKey . '_form';
?>



<div id="<?php echo $nameKey . '_' . $valueKey; ?>" class="well">
	<form action="<?php echo $urlForm; ?>" method="post" id="<?php echo $formId; ?>" class="form-validate form-horizontal">
	
	<?php if(is_object($this->form)) : ?> 
	
		<?php foreach ($this->form->getFieldset('account') as $field) : ?>
			<?php if(!($field->hidden)) : ?>
			<div class="control-group">		
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>
			</div>
			<?php else : echo $field->input; endif; ?>
		<?php endforeach; ?>
		
	<?php endif; ?>	
	
		<div class="pull-right clearfix" align="right">
			<div class="btn-group">
			<?php 
			$params = array(
				'optionCom' => $optionCom,
				'nameKey' => $nameKey, 
				'valueKey' => $valueKey,
				'task' => 'save',
				'idPostfix' => 'form',
				'class' => 'primary',
				'btnType' => 'submit',
				'validate' => true,
			);
			echo EcBtn::submit($params);
			$params['btnType'] = 'button';
			$params['class'] = 'default';
			$params['task'] = 'cancel';
			$params['validate'] = false;
			echo EcBtn::submit($params); 
			?>
			</div>
		</div><br />
	
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	
	</form>

</div>