<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

$valueKey = $topiccmt->$nameKey; //EcDebug::lp($topiccmt);
$idForm = $nameKey . '_' . $valueKey . '_' . $nameCol . '_' . $valueCol . '_form';
$urlForm = JRoute::_(JUri::getInstance());
$topiccmtUsername = $topiccmt->username;
$topiccmtBody = nl2br($topiccmt->body);
$topiccmtModified = $topiccmt->modified;
?>

<form action="<?php echo $urlForm; ?>" method="post" id="<?php echo $idForm; ?>" class="form-validate form-horizontal">
	<div style="margin: 10px 0px 10px 0px;">

		<div class="pull-left" style="width:95%;">	
			<div style="padding: 0px 0px 5px 20px;">
				<?php echo $topiccmtModified.$seperator.$topiccmtUsername; ?>
			</div>
			<div style="border: solid 1px #dddddd; padding: 10px;">
				<?php echo $topiccmtBody; ?>
			</div>
		</div>
			
		<div class="pull-right" style="width:5%" align="right">
			<div class="btn-group">
				<?php echo EcBtn::caret(false); ?>
				<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">
					<?php 
					$params = array(
						'optionCom' => $optionCom,
						'nameKey' => $nameKey,
						'valueKey' => $valueKey,
						'nameCol' => $nameCol,
						'valueCol' => $valueCol,
						'task' => 'delete',
						'idPostfix' => 'form',
						'validate' => false,
						'disable' => !(EcPermit::allowEdit($topiccmt)),
					);
					echo EcBtn::submitLi($params);
					?>
				</ul>
			</div>
		</div>		
			
		<input type="hidden" name="jform[<?php echo $nameKey; ?>]" value="<?php echo $valueKey; ?>" />
		<input type="hidden" name="jform[<?php echo $nameCol; ?>]" value="<?php echo $valueCol; ?>" />
		<input type="hidden" name="jform[user]" value="0" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
			
	</div><div class="clearfix"></div>
</form>