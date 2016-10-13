<?php /** @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');

//TODO reformatting



$lengthList = $params->get('length_list');
$lengthItem = $params->get('length_item');
$widthItem = $params->get('width_item');
$seperator = '&nbsp;&middot;&nbsp;';



echo '<div class="clearfix">';
	foreach ($topics as $count => $topic) {
		if($count >= $lengthList) break;
		
		$url = JRoute::_('index.php?option=com_ectopic&view=topic&topiccat='
			.$topic->topiccat.'&topic='.$topic->topic.'&Itemid='.$itemId);
		$date = date('Y/m/d', strtotime($topic->created));
		$title = JHtml::_('string.truncateComplex', $topic->title, $lengthItem);
		$hits = JText::sprintf('MOD_ECTOPIC_TOPICS_HITS_POSTFIX', $topic->hits);
		$topiccmt = ($topic->topiccmt > 0) ? $seperator.JText::sprintf
			('MOD_ECTOPIC_TOPICS_TOPICCMT_POSTFIX', $topic->topiccmt) : null;
		$topiclike = ($topic->topiclike) ? $seperator.JText::sprintf
			('MOD_ECTOPIC_TOPICS_TOPICLIKE_POSTFIX', $topic->topiclike) : null;
		
		echo '<div class="pull-left clearfix" style="width: '.$widthItem.'px;">';
			echo '<div class="pull-left" style="padding: 10px 5px 5px 5px;">';
				echo '<span class="icon-edit"></span>';
			echo '</div>';
			echo '<div class="pull-left">';
				echo '<div><a href="'.$url.'">'.$title.'</a></div>';
				echo '<div>'.$date.$seperator.$hits.$topiccmt.$topiclike.'</div>';
			echo '</div>';
		echo '</div>';
	}
echo '</div>';