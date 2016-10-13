<?php /** @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');

//TODO reformatting



echo '<fieldset><legend>'.$title.'</legend>';
	echo '<div class="pull-left span5">';
		echo '<div class="center">'.$datetime.$seperator.$hits.$topiccmt.$topiclike.$numberFile.$numberImg.'</div>';
	echo '</div>';
	echo '<div class="pull-right span5">';
		echo '<div class="center">'.$topiccatTitle.$seperator.$username.'</div>';
	echo '</div><div class="clearfix"></div>';
	echo '<div style="border: solid 1px #dddddd; padding: 20px 10px 20px 10px;">'
			.($item->body).'</div>';
echo '</fieldset>';



if($existImg) echo '<div align="center" style="margin: 10px;"><a href="'
	.JUri::base().$imgs['img'].'" target="_new"><img class="media-object thumbnail" src="'
	.JUri::base().$imgs['imgthumb'].'" alt=""></a></div>';
if($existFile) echo '<div><a href="'.JUri::base().$files['file'].'">'.basename($files['file']).'</a></div>';