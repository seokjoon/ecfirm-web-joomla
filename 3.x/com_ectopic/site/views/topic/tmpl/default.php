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

$topiccat = $item->topiccat;//EctopicUrl::getTopiccat();
$itemId = EcUrl::getItemId();
$urlPlural = JRoute::_('index.php?option='.$optionCom.'&view='.$nameKey.'s&&topiccat='
	.$topiccat.'&Itemid='.$itemId);

$seperator = '&nbsp;&middot;&nbsp;';
$datetime = EcDatetime::interval($item->created);
if($item->created < $item->modified)
	$datetime = $datetime.$seperator.EcDatetime::interval($item->modified);
$title = $item->title;
$username = '<a href="'.JRoute::_('index.php?option=com_ecuser&view=user&user='
	.$item->user).'">'.$item->username.'</a>';
$hits = JText::sprintf('COM_ECTOPIC_TOPIC_HITS_NUMBER', $item->hits);
$topiccmt = ($item->topiccmt > 0) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_TOPICCMT_NUMBER', $item->topiccmt) : null;
$topiclike = ($item->topiclike) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_TOPICLIKE_NUMBER', $item->topiclike) : null;
$topiccatTitle = JHtml::_('string.truncateComplex', $item->topiccatTitle, 15);
$files = json_decode($item->files, true); //EcDebug::lp(count($files));
$imgs = json_decode($item->imgs, true); //EcDebug::lp(count($imgs));
$countFile = count($files);
$countImg = (count($imgs))/2;
$existFile = (($countFile > 0) && (array_key_exists('file', $files)) && (!empty($files['file'])));
$existImg = (($countImg > 0) && (array_key_exists('img', $imgs)) && (!empty($imgs['img'])));
$numberFile = ($existFile) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_FILE_NUMBER', $countFile) : null;
$numberImg = ($existImg) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_IMG_NUMBER', $countImg) : null;

$user = JFactory::getUser();
?>



<form action="<?php echo JUri::getInstance()->toString(); ?>" method="post" id="<?php echo $nameKey.'_'.$valueKey; ?>" class="form-validate">
	<div class="pull-right" align="right">
		<div class="btn-group">
			<a class="btn btn-default" href="<?php echo $urlPlural; ?>"><?php echo JText::_('COM_ECTOPIC_TOPICS'); ?></a>
			<?php echo EcBtn::caret(true); ?>
			<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">
				<?php 
				$params = array(
					'optionCom' => $optionCom, 
					'nameKey' => $nameKey,
					'valueKey' => $valueKey,
					'task' => 'edit',
					'disable' => !(EcPermit::allowEdit($item)),
				);
				echo EcBtn::submitLi($params);
				?>
				<li class="divider"></li>
				<?php 
				$params['task'] = 'delete';
				echo EcBtn::submitLi($params);
				?>
			</ul>
		</div>
	</div>
	<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'">
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form><div class="clearfix"></div>

	
	
<div class="form-horizontal">
	<?php 
	echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active'=>'topic'));
		echo JHtml::_('bootstrap.addTab', 'myTab', 'topic', JText::_('COM_ECTOPIC_TOPIC_DISPLAY_TOPIC'));
			if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;
				require_once 'default_topic.php';
			if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;
		echo JHtml::_('bootstrap.endTab');
		echo JHtml::_('bootstrap.addTab', 'myTab', 'topiccmt', JText::_('COM_ECTOPIC_TOPIC_DISPLAY_TOPICCMT').'('.$item->topiccmt.')');
			require_once 'edit_topiccmt.php';
			require_once 'default_topiccmts.php';
		echo JHtml::_('bootstrap.endTab');
	echo JHtml::_('bootstrap.endTabSet');
	?>
</div>