<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later
 */
defined('_JEXEC') or die('Restricted access');



$repository = $params->get('username') . '/' . $params->get('repository');
$repository = 'https://github.com/' . $repository . '/commit/';
$lengthList = $params->get('length_list');
?>



<?php foreach ($events as $count => $event) : ?>
	<?php
	if ($count >= $lengthList) break;
	$avatar = $event->actor->avatar_url;
	$actorName = $event->actor->login;
	$url = $repository . $event->payload->head;
	$msg = $event->payload->commits[0]->message;
	$msg = JHtml::_('string.truncateComplex', $msg, $params->get('length_item'));
	$date = date('Y/m/d', strtotime($event->created_at));
	?>
	<div class="clearfix">
		<div class="pull-left" style="margin-right: 5px;">
			<img src="<?php echo $avatar; ?>" width="30px;" height="30px;" />
		</div>
		<div>
			<div>[<?php echo $date; ?>]&nbsp;<?php echo $actorName; ?></div>
			<div>
				<a href="<?php echo $url; ?>" target="_new"><?php echo $msg; ?></a>
			</div>
		</div>
	</div>
<?php endforeach; ?>