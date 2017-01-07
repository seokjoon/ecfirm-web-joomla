<?php 
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

$item = $this->item; //EcDebug::lp($item);
$optionCom = $this->optionCom;
$nameKey = $this->nameKey;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;

$seperator = '&nbsp;&middot;&nbsp;';
if(isset($item->imgs)) $imgs = json_decode($item->imgs, true);

$urlForm = JRoute::_(JUri::getInstance());
$formId = $nameKey . '_' . $valueKey . '_form';

?>



<?php if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay; ?>



<div class="pull-right">
	<form action="<?php echo $urlForm; ?>" method="post" id="<?php echo $formId; ?>" class="form-validate form-vertical">
	
		<div class="pull-left" style="" align="left"></div>
	
		<div class="pull-right" style="" align="right">
			<div class="btn-group">
			<?php 
			$params = array(
				'optionCom' => $optionCom, 
				'nameKey' => $nameKey, 
				'valueKey' => $valueKey, 
				'idPostfix' => 'form', 
				'task' => 'editProfile',
			); 
			$params['disable'] = !(EcPermit::allowEdit($item));
			echo EcBtn::submit($params);
			echo EcBtn::caret(true);
			echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
				$params['task'] = 'editAccount';
				echo EcBtn::submitLi($params);
				$params['task'] = 'logout';
				echo EcBtn::submitLi($params);
				echo '<li class="divider"></li>';
				$params['task'] = 'delete';
				echo EcBtn::submitLi($params);
			echo '</ul>';
			?>		
			</div>
		</div>
	
		<input type="hidden" name="<?php echo $nameKey; ?>" value="<?php echo $valueKey; ?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	
	</form>

</div><div class="clearfix"></div>



<div class="form-horizontal">
<?php 
echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active'=>'user'));
	echo JHtml::_('bootstrap.addTab', 'myTab', 'user', JText::_('COM_NSUSER_USER_TAB_USER'));
		require_once 'default_user.php';
	echo JHtml::_('bootstrap.endTab');
echo JHtml::_('bootstrap.endTabSet');
?>
</div>



<?php if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay; ?>