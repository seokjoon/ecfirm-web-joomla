<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select'); 

$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$topiccat = EctopicUrl::getTopiccat();
$itemId = EcUrl::getItemId();
$topiccatTitle = JHtml::_('string.truncateComplex', $this->topiccatTitle, 70);
$topiccatBody = nl2br($this->topiccatBody);
$seperator = '&nbsp;&middot;&nbsp;';
?>



<div>
	<div class="pull-left">
		<fieldset>
			<legend><?php echo $topiccatTitle; ?></legend>
			<small><?php echo $topiccatBody; ?></small>
		</fieldset>
	</div>
	<div class="pull-right">
		<form action="<?php echo JRoute::_(JUri::getInstance()); ?>" method="post" id="<?php echo $nameKey.'_0'; ?>" class="form_validate">
			<?php 
			$params = array(
				'optionCom' => $optionCom, 
				'nameKey' => $nameKey, 
				'task' => 'add', 
				'disable' => !(EcPermit::allowAdd())
			); 
			?>
			<?php echo EcBtn::submit($params); ?>
			<input type="hidden" name="task" value="" />
		</form>
	</div><div class="clearfix"></div>
</div>



<div>
<form action="<?php echo JRoute::_(JUri::getInstance()); ?>" method="post" name="adminForm" id="adminForm">

	<?php if(!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2"><?php echo $this->sidebar; ?></div>
	<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
	<?php endif; ?>

		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
	
		<?php if(empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS'); ?>	
		</div>
		<?php else : ?>



		<table class="table table-striped" id="articleList">
	
			<thead><tr>
				<th class="center span8">
					<?php echo JText::_('COM_ECTOPIC_TOPICS_TITLE_HEADER'); ?>
				</th>
				<th class="center hidden-phone span4">
					<?php echo JText::_('COM_ECTOPIC_TOPICS_USERNAME_HEADER'); ?>
				</th>
			</tr></thead>
			
			<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
				<?php 
				$title = JHtml::_('string.truncateComplex', $item->title, 70);
				$title = '<a href="'.JRoute::_('index.php?option='.$optionCom.'&view=' .$nameKey
					.'&'.$nameKey.'='.$item->topic.'&topiccat='.$topiccat.'&Itemid='.$itemId).'">'.$title.'</a>';
				$datetime = EcDatetime::interval($item->created); 
				if($item->created < $item->modified) 
					$datetime = $datetime.$seperator.EcDatetime::interval($item->modified);
				$username = '<a href="'.JRoute::_('index.php?option=com_ecuser&view=user&user='
					.$item->user).'">'.$item->username.'</a>';
				$hits = JText::sprintf('COM_ECTOPIC_TOPIC_HITS_NUMBER', $item->hits);
				$topiccmt = ($item->topiccmt > 0) ? $seperator.JText::sprintf
					('COM_ECTOPIC_TOPIC_TOPICCMT_NUMBER', $item->topiccmt) : null;
				$topiclike = ($item->topiclike) ? $seperator.JText::sprintf
					('COM_ECTOPIC_TOPIC_TOPICLIKE_NUMBER', $item->topiclike) : null;
				$files = json_decode($item->files, true); //EcDebug::lp(count($files));
				$imgs = json_decode($item->imgs, true); //EcDebug::lp(count($imgs));
				$countFile = count($files);
				$countImg = (count($imgs))/2;
				$existFile =  (($countFile > 0) && (array_key_exists('file', $files)) && (!empty($files['file'])));
				$existImg =  (($countImg > 0) && (array_key_exists('img', $imgs)) && (!empty($imgs['img'])));
				$numberFile = ($existFile) ? 
				$seperator.JText::sprintf('COM_ECTOPIC_TOPIC_FILE_NUMBER', $countFile) : null;
				$numberImg = ($existImg) ? 
					$seperator.JText::sprintf('COM_ECTOPIC_TOPIC_IMG_NUMBER', $countImg) : null;
				?>
				<tr class="row<?php echo ($i % 2); ?>" sortable-group-id="<?php echo $item->topic; ?>">
					<td class="has-context">
						<div><?php echo $title; ?></div>
						<div><small><?php echo $datetime.$seperator.$hits.$topiccmt.$topiclike.$numberFile.$numberImg; ?></small></div>
					</td>
					<td class="center hidden-phone">
						<div><?php echo $username; ?></div>
						<div><small></small></div>
					</td>
				</tr>
				
			<?php endforeach; ?>
			</tbody>
		
		</table>


			
		<?php endif; ?>
		
		<?php //echo $this->pagination->getListFooter(); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>	

	</div>

</form>
</div>



<?php if($this->pagination->pagesTotal > 1) : ?>
<div class="pagination">
	<p class="counter pull-right"><?php echo $this->pagination->getPagesCounter(); ?></p>
	<?php echo $this->getPagesLinks(); ?>
</div>
<?php endif; ?>	