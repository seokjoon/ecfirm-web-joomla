<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$repository = 'https://github.com/'.$params->get('username').'/'.$params->get('repository');
$lengthList = $params->get('length_list');
$lengthItem = $params->get('length_item');
$widthItem = $params->get('width_item');
$seperator = '&nbsp;&middot;&nbsp;';



echo '<div class="clearfix">';
	if(empty($events)) echo JText::_('MOD_ECHITHUB_NO_MATCHING_RESULTS');
	else {
		foreach ($events as $count => $event) {
			if($count >= $lengthList) break;
			$avatar = $event->actor->avatar_url;
			$actorName = $event->actor->login;
			if(isset($event->milestone)) {
				$url = $repository.'/milestone/'.$event->issue->number;
				$title = $event->	milestone->title;
			} else {
				$url = $repository.'/issues/'.$event->issue->number;
				$title = $event->issue->title;
			}
			$title = JHtml::_('string.truncateComplex', $title, $lengthItem);
			$date = date('Y/m/d', strtotime($event->created_at));
	
			echo '<div class="pull-left clearfix" style="width: '.$widthItem.'px;">';
				echo '<div class="pull-left" style="margin-right: 5px;">';
					echo '<img src="'.$avatar.'" width="30px;" height="30px;" />';
				echo '</div>';
				echo '<div class="pull-left">';
					echo '<div><a href="'.$url.'" target="_new">'.$title.'</a></div>';
					echo '<div>'.$date.$seperator.$actorName.'</div>';
				echo '</div>';
			echo '</div>';
		}
	}
echo '</div>'; 

echo '<span class="label label-default">'.$timeCache.' '
	.JText::_('MOD_ECGITHUB_TIME_CACHE_LABEL').'</span>';