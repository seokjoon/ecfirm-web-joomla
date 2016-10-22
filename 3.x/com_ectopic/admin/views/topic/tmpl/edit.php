<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

$app = JFactory::getApplication();
$input = $app->input;
$urlForm = JRoute::_('index.php?option=com_ectopic&layout=edit&topic=' . (int)$this->item->topic);
?>



<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if(document.formvalidator.isValid(document.id("item-form"))){
			Joomla.submitform(task, document.getElementById("item-form")); 
		} 
	}
</script>



<form action="<?php echo $urlForm; ?>" method="post" name="adminForm" id="item-form" class="form-validate">

	<div class="form-horizontal">
	
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active'=>'topic')); ?>
		
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'topic', JText::_('COM_ECTOPIC_TOPIC_TOPIC', true)); ?>
				<?php foreach ($this->form->getFieldset('topic') as $field) : ?>
					<?php if(!($field->hidden)) : ?>
						<div class="control-group">
							<div class="control-label"><?php echo $field->label; ?></div>
							<div class="controls"><?php echo $field->input; ?></div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'options', JText::_('COM_ECTOPIC_TOPIC_OPTIONS', true)); ?>
				<?php foreach ($this->form->getFieldset('options') as $field) : ?>
					<?php if(!($field->hidden)) : ?>
						<div class="control-group">
							<div class="control-label"><?php echo $field->label; ?></div>
							<div class="controls"><?php echo $field->input; ?></div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
			
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo $input->getCmd('return'); ?>" />
		<?php echo JHtml::_('form.token'); ?>

	</div>
	
</form>