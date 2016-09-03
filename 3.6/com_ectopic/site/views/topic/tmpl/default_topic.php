<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



echo '<fieldset><legend>'.$title.'</legend>';
	echo '<div class="pull-left span5">';
		echo '<div class="center">'.$modified.$seperator.$hits.$topiccmt.$topiclike.$numberFile.$numberImg.'</div>';
	echo '</div>';
	echo '<div class="pull-right span5">';
		echo '<div class="center">'.$topiccatTitle.$seperator.$username.'</div>';
	echo '</div><div class="clearfix"></div>';
	echo '<div style="border: solid 1px #dddddd; padding: 20px 10px 20px 10px;">'
			.nl2br($item->body).'</div>';
echo '</fieldset>';



if($existImg) echo '<div align="center" style="margin: 10px;"><a href="'
	.JUri::base().$imgs['img'].'"><img class="media-object thumbnail" src="'
	.JUri::base().$imgs['imgthumb'].'" alt=""></a></div>';
if($existFile) echo '<div><a href="'.JUri::base().$files['file'].'">'.basename($files['file']).'</a></div>';