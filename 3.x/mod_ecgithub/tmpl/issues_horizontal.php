<?php
/**
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



$repository = 'https://github.com/' . $params->get('username') . '/' . $params->get('repository');
$lengthList = $params->get('length_list');
$lengthItem = $params->get('length_item');
$widthItem = $params->get('width_item');
$seperator = '&nbsp;&middot;&nbsp;'; //echo '<pre>'.print_r($events, 1).'</pre>';
?>



<div class="clearfix">
<?php if(empty($events)) : ?>
	<?php echo JText::_('MOD_ECHITHUB_NO_MATCHING_RESULTS'); ?>
<?php else : ?>
	<?php foreach ($events as $count => $event) : ?>
		<?php
		if ($count >= $lengthList) break;
		$avatar = $event->actor->avatar_url;
		$actorName = $event->actor->login;
		$url = $repository . '/issues/' . $event->issue->number;
		$title = $event->issue->title;
		$title = JHtml::_('string.truncateComplex', $title, $lengthItem);
		$date = date('Y/m/d', strtotime($event->created_at));
		?>
		<div class="pull-left clearfix" style="width: <?php echo $widthItem; ?>px;">
		<div class="pull-left" style="margin-right: 5px;">
			<img src="<?php echo $avatar; ?>" width="30px;" height="30px;" />
		</div>
		<div class="pull-left">
			<div>
				<a href="<?php echo $url; ?>" target="_new"><?php echo $title; ?></a>
			</div>
			<div><?php echo $date . $seperator . $actorName; ?></div>
		</div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>
</div>

<span class="label label-default">
	<?php echo $timeCache . ' ' . JText::_('MOD_ECGITHUB_TIME_CACHE_LABEL'); ?>
</span>