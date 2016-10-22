<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$item = $this->item;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
?>



<div id="<?php echo $nameKey . '_' . $valueKey;?>" class="well form-horizontal">

	<form action="<?php echo JUri::getInstance()->toString(); ?>" method="post" id="<?php echo $nameKey . '_' . $valueKey . '_form';?>" class="form-validate form-horizontal" enctype="multipart/form-data">

		<?php if(is_object($this->form)) : ?>	
		
			<?php foreach(($this->form->getFieldset('topic')) as $field) : ?>
				<?php if(!($field->hidden)) : ?>
					<?php echo $field->label; ?>
					<?php echo $field->input; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			
			<?php foreach(($this->form->getFieldset('file')) as $field) : ?>
				<?php if(!($field->hidden)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $field->label; ?></div>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		
			<?php foreach(($this->form->getFieldset('topic')) as $field) : ?>
				<?php if($field->hidden) : ?>
					<?php echo $field->input; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			
		<?php endif; ?>
		
	
		<span style="float:right">
			<div class="btn-group">
				<?php 
				$params = array(
					'optionCom' => $optionCom,
					'nameKey' => $nameKey,
					'valueKey' => $valueKey,
					'idPostfix' => 'form',
					'task' => 'save',
					'validate' => true,
					'class' => 'primary',
				);
				echo EcBtn::submit($params);
				$params['task'] = 'cancel';
				$params['class'] = 'default';
				$params['validate'] = false;
				echo EcBtn::submit($params);
				?>
			</div>
		</span><div>&nbsp;</div>
	
		<input type="hidden" name="jform[topiccat]" value="<?php echo EctopicUrl::getTopiccat(); ?>" />
		<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	
	</form>

</div>