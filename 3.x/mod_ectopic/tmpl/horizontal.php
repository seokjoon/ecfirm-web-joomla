<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



$lengthList = $params->get('length_list');
$lengthItem = $params->get('length_item');
$widthItem = $params->get('width_item');
$seperator = '&nbsp;&middot;&nbsp;';
?>



<div class="clearfix">
<?php foreach ($topics as $count => $topic) : ?>
	<?php if($count >= $lengthList) break; ?>
	<?php
	$url = JRoute::_('index.php?option=com_ectopic&view=topic&topiccat=' . $topic->topiccat . '&topic=' . $topic->topic . '&Itemid=' . $itemId);
	$date = date('Y/m/d', strtotime($topic->created));
	$title = JHtml::_('string.truncateComplex', $topic->title, $lengthItem);
	$hits = JText::sprintf('MOD_ECTOPIC_TOPICS_HITS_POSTFIX', $topic->hits);
	$topiccmt = ($topic->topiccmt > 0) ? $seperator . JText::sprintf('MOD_ECTOPIC_TOPICS_TOPICCMT_POSTFIX', $topic->topiccmt) : null;
	$topiclike = ($topic->topiclike) ? $seperator . JText::sprintf('MOD_ECTOPIC_TOPICS_TOPICLIKE_POSTFIX', $topic->topiclike) : null;
	?>
	<div class="pull-left clearfix" style="width: <?php echo $widthItem; ?>px;">
		<div class="pull-left" style="padding: 10px 5px 5px 5px;">
			<span class="icon-edit"></span>
		</div>
		<div class="pull-left">
			<div>
				<a href="<?php echo $url; ?>"><?php echo $title; ?></a>
			</div>
			<div><?php echo $date . $seperator . $hits . $topiccmt . $topiclike; ?></div>
		</div>
	</div>
<?php endforeach; ?>
</div>