<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



$item = $this->item; 
$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;

$idDiv = $nameKey.'_'.$valueKey;
$idForm = $idDiv . '_form';
$urlForm = JUri::getInstance()->toString();
?>



<div id="<?echo $idDiv; ?>" class="well">
	<form action="<?php echo $urlForm; ?>" method="post" id="<?php echo $idForm; ?>" class="form-validate form-horizontal">
		<?php if(is_object($this->form)) : //EcDebug::lp($this->form); ?>
			<?php foreach($this->form->getFieldset('profile') as $field) : ?>
				<?php if($field->hidden) : ?>
					<?php echo $field->input; ?>
				<?php else : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $field->label; ?></div>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<div class="pull-right clearfix" align="right" >
			<div class="btn-group">
				<?php 
				$params = array(
					'optionCom' => $optionCom, 
					'nameKey' => $nameKey, 
					'valueKey' => $valueKey, 
					'task' => 'save', 
					'idPostfix' => 'form',
					'class' => 'primary', 
					'btnType' => 'submit'
				);
				echo EcBtn::submit($params);
				$params['btnType'] = 'button';
				$params['class'] = 'default';
				$params['task'] = 'cancel';
				echo EcBtn::submit($params);
				?>
			</div>
		</div><br /> 
		
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>