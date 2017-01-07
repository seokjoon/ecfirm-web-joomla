<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. 
 */
defined('_JEXEC') or die('Restricted access');



$avatarSize = 200;
$avatarHash = md5(strtolower(trim($item->email)));
$avatarUrl  = '//www.gravatar.com/avatar/'.$avatarHash.'.jpg?s='.$avatarSize;
$avatar = '<img src="'.$avatarUrl.'" alt="" />';

$email = str_replace('@', ' (at) ', $item->email);
$email = JHtml::_('string.truncate', $email, 30);
$name = JHtml::_('string.truncate', $item->name, 30);
$groupTitle = null;
$groups = EcuserHelper::getUsergroupTitle();
foreach ($item->groups as $group) 
	$groupTitle .= (empty($groupTitle)) ? $groups[$group] : $seperator.$groups[$group];
$registerDate = date('Y-m-d H:i:s', strtotime($item->registerDate));
$lastvisitDate = date('Y-m-d H:i:s', strtotime($item->lastvisitDate));
$urls = json_decode($item->urls, true); //EcDebug::lp($urls);
$urlDefault = ((isset($urls['default'])) && (!empty($urls['default']))) ? $urls['default'] : null;
if(!empty($urlDefault)) 
	$urlDefault = '<a href="'.$urlDefault.'" target="_new" style="color: white">'.$urlDefault.'</a>';
$hits = number_format($item->hits);
?>



<div class="container-fluid">



	<div class="pull-left span6">
		<table class="category table table-bordered table-hover">
			<tbody>
				<tr><td class="center">
					<?php echo $avatar; ?>
				</td></tr>
			</tbody>
		</table>
	</div>

	

	<div class="pull-right span6">
		<table class="category table table-bordered table-hover">
			<tbody>
				<tr><td>
					<?php echo JText::_('COM_ECUSER_USER_NAME_LABEL'); ?>
					<span class="label pull-right"><?php echo $name; ?></span>
				<tr><td>
					<?php echo JText::_('COM_ECUSER_USER_EMAIL_LABEL'); ?>
					<span class="label pull-right"><?php echo $email; ?></span>
				</td></tr>
				<tr><td>
					<?php echo JText::_('COM_ECUSER_USER_GROUPS_LABEL'); ?>
					<span class="label pull-right"><?php echo $groupTitle; ?></span>
				</td></tr>
				<tr><td>
					<?php echo JText::_('COM_ECUSER_USER_REGISTER_DATE_LABEL'); ?>
					<span class="label pull-right"><?php echo $registerDate; ?></span>
				</td></tr>
				<tr><td>
					<?php echo JText::_('COM_ECUSER_USER_LASTVISIT_DATE_LABEL'); ?>
					<span class="label pull-right"><?php echo $lastvisitDate; ?></span>
				</td></tr>
				<tr><td>
					<?php echo JText::_('COM_ECUSER_USER_URL_DEFAULT_LABEL'); ?>
					<span class="label pull-right"><?php echo $urlDefault; ?></span>
				</td></tr>
				<tr><td>
					<?php echo JText::_('COM_ECUSER_USER_HITS_LABEL'); ?>
					<span class="label pull-right"><?php echo $hits; ?></span>
				</td></tr>
			</tbody>
		</table>
	</div>



</div>