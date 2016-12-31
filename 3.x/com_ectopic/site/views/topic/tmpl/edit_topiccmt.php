<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

$nameCol = $nameKey; //switch
$valueCol = $valueKey;
$nameKey = $nameCol . 'cmt';
$valueKey = 0;
?>



<form action="<?php echo JUri::getInstance()->toString(); ?>"
	method="post" id="<?php echo $nameKey . '_' . $valueKey; ?>"
	class="form-validate form-horizontal">
	
	<?php
	if (is_object($this->topiccmtForm)) {
		foreach ($this->topiccmtForm->getFieldset('topiccmt') as $field) {
			if ($field->name == 'jform[body]') {
				$body = (EcPermit::allowAdd()) ? str_replace('readonly ', '', $field->input) : $field->input;
				echo str_replace('<textarea', '<textarea style="width: 98%;"', $body);
			} else
				echo $field->input;
		}
	}
	?>
	
	<div style="margin: 10px 0px 30px 0px;">
		<span style="float: right">
			<div class="btn-group">
				<?php
				$params = array(
					'optionCom' => $optionCom,
					'nameKey' => $nameKey,
					'task' => 'save', //validate is false: use submitform instead of submitbutton
					'disable' => ! (EcPermit::allowAdd())
				);
				echo EcBtn::submit($params); //EcDebug::lp($params);	
				?>
			</div>
		</span>
	</div>

	<input type="hidden" name="jform[<?php echo $nameCol; ?>]" value="<?php echo $valueCol; ?>" />
	<input type="hidden" name="task" value="" />
	
	<?php echo JHtml::_('form.token'); ?>
</form>