<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$repository = $params->get('username').'/'.$params->get('repository');
$repository = 'https://github.com/'.$repository.'/commit/';
$lengthList = $params->get('length_list');
$lengthItem = $params->get('length_item');
$widthItem = $params->get('width_item');
$seperator = '&nbsp;&middot;&nbsp;'; //echo '<pre>'.print_r($events, 1).'</pre>';



echo '<div class="clearfix">';
	$count = 0;
	foreach ($events as $event) { //foreach ($events as $count => $event) {
		if($count >= $lengthList) break;
		$count++;
		$avatar = $event->actor->avatar_url;
		$actorName = $event->actor->login;
		$url = $repository.$event->payload->head;
		$msg = $event->payload->commits[0]->message;
		$msg = JHtml::_('string.truncateComplex', $msg, $lengthItem);
		$date = date('Y/m/d', strtotime($event->created_at));
	
		echo '<div class="pull-left clearfix" style="width: '.$widthItem.'px;">';
			echo '<div class="pull-left" style="margin-right: 5px;">';
				echo '<img src="'.$avatar.'" width="30px;" height="30px;" />';
			echo '</div>';
			echo '<div class="pull-left">';
				echo '<div><a href="'.$url.'" target="_new">'.$msg.'</a></div>';
				echo '<div>'.$date.$seperator.$actorName.'</div>';
			echo '</div>';
		echo '</div>';
	}
echo '</div>'; 

echo '<span class="label label-default">'.$timeCache.' '
	.JText::_('MOD_ECGITHUB_TIME_CACHE_LABEL').'</span>';