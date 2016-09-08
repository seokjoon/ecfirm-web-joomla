<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$repository = $params->get('username').'/'.$params->get('repository');
$repository = 'https://github.com/'.$repository.'/commit/';
$lengthList = $params->get('length_list');
foreach ($commits as $count => $commit) {
	if($count >= $lengthList) break;
	$avatar = $commit->actor->avatar_url;
	$url = $repository.$commit->payload->head;
	$msg = $commit->payload->commits[0]->message;
	$msg = JHtml::_('string.truncateComplex', $msg, $params->get('length_item'));
	$date = date('Y/m/d', strtotime($commit->created_at));
	
	echo '<div style="margin: 5px;">';
		//echo '<span class="icon-edit"></span>'.$date.'&nbsp;';
		echo '<img src="'.$avatar.'" width="30px;" height="30px;" />';
		echo '&nbsp;['.$date.']&nbsp;';
		echo '<a href="'.$url.'" target="_new">'.$msg.'</a>';
	echo '</div>';
}