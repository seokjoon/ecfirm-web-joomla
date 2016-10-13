<?php /** @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');

//TODO reformatting



$repository = $params->get('username').'/'.$params->get('repository');
$repository = 'https://github.com/'.$repository.'/commit/';
$lengthList = $params->get('length_list');



foreach ($events as $count => $event) {
	if($count >= $lengthList) break;
	$avatar = $event->actor->avatar_url;
	$actorName = $event->actor->login;
	$url = $repository.$event->payload->head;
	$msg = $event->payload->commits[0]->message;
	$msg = JHtml::_('string.truncateComplex', $msg, $params->get('length_item'));
	$date = date('Y/m/d', strtotime($event->created_at));
	
	echo '<div class="clearfix">';
		echo '<div class="pull-left" style="margin-right: 5px;">';
			echo '<img src="'.$avatar.'" width="30px;" height="30px;" />';
		echo '</div>';
		echo '<div>';
			echo '<div>['.$date.']&nbsp;'.$actorName.'</div>';
			echo '<div><a href="'.$url.'" target="_new">'.$msg.'</a></div>';
		echo '</div>';
	echo '</div>';
}