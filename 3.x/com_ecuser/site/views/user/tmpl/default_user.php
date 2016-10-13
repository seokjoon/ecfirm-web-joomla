<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');

//TODO: reformatting



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




echo '<div class="container-fluid">';



	echo '<div class="pull-left span6">';
		echo '<table class="category table table-bordered table-hover">';
			echo '<tbody>';
				echo '<tr><td class="center">';
					echo $avatar;
				echo '</td></tr>';
			echo '</tbody>';
		echo '</table>';
	echo '</div>';

	

	echo '<div class="pull-right span6">';
		echo '<table class="category table table-bordered table-hover">';
			echo '<tbody>';
				echo '<tr><td>';
					echo JText::_('COM_ECUSER_USER_NAME_LABEL');
					echo '<span class="label pull-right">'.$name.'</span>';
				echo '<tr><td>';
					echo JText::_('COM_ECUSER_USER_EMAIL_LABEL');
					echo '<span class="label pull-right">'.$email.'</span>';
				echo '</td></tr>';
				echo '<tr><td>';
					echo JText::_('COM_ECUSER_USER_GROUPS_LABEL');
					echo '<span class="label pull-right">'.$groupTitle.'</span>';
				echo '</td></tr>';
				echo '<tr><td>';
					echo JText::_('COM_ECUSER_USER_REGISTER_DATE_LABEL');
					echo '<span class="label pull-right">'.$registerDate.'</span>';
				echo '</td></tr>';
				echo '<tr><td>';
					echo JText::_('COM_ECUSER_USER_LASTVISIT_DATE_LABEL');
					echo '<span class="label pull-right">'.$lastvisitDate.'</span>';
				echo '</td></tr>';
				echo '<tr><td>';
					echo JText::_('COM_ECUSER_USER_URL_DEFAULT_LABEL');
					echo '<span class="label pull-right">'.$urlDefault.'</span>';
				echo '</td></tr>';
				echo '<tr><td>';
					echo JText::_('COM_ECUSER_USER_HITS_LABEL');
					echo '<span class="label pull-right">'.$hits.'</span>';
				echo '</td></tr>';
			echo '</tbody>';
		echo '</table>';
	echo '</div>';



echo '</div>';