<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
$app = JFactory::getApplication();
$input = $app->input;



echo '<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if(document.formvalidator.isValid(document.id("item-form"))){'
			.'Joomla.submitform(task, document.getElementById("item-form")); } }
</script>';



echo '<form action="'.JRoute::_('index.php?option=com_ectopic&layout=edit&topic='
	.(int)$this->item->topic).'" method="post" name="adminForm" id="item-form" '
	.'class="form-validate">';
	//echo JLayoutHelper::render('joomla.edit.title_alias', $this);
	echo '<div class="form-horizontal">';
		echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active'=>'topic'));

		echo JHtml::_('bootstrap.addTab', 'myTab', 'topic',
			JText::_('COM_ECTOPIC_TOPIC_TOPIC', true));
		foreach ($this->form->getFieldset('topic') as $field)	{
			if(!$field->hidden) {
				echo '<div class="control-group">';
					echo '<div class="control-label">'.$field->label.'</div>';
					echo '<div class="controls">'.$field->input.'</div>';
				echo '</div>'; 
			}
		}
		echo JHtml::_('bootstrap.endTab');

	//if ($this->canDo->get('core.admin'))	{
		echo JHtml::_('bootstrap.addTab', 'myTab', 'options',
			JText::_('COM_ECTOPIC_TOPIC_OPTIONS', true));
		foreach ($this->form->getFieldset('options') as $field)	{
			echo '<div class="control-group">';
				echo '<div class="control-label">'.$field->label.'</div>';
				echo '<div class="controls">'.$field->input.'</div>';
			echo '</div>'; 
		}
		echo JHtml::_('bootstrap.endTab');
	//}
		echo JHtml::_('bootstrap.endTabSet');
		echo '<input type="hidden" name="task" value="" />';
		echo '<input type="hidden" name="return" value="'.$input->getCmd('return').'" />';
		echo JHtml::_('form.token');
	echo '</div>';
echo '</form>';