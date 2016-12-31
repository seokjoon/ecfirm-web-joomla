<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');
?>



<fieldset><legend><?php echo $title; ?></legend>
	<div class="pull-left span5">
		<div class="center"><?php echo $datetime.$seperator.$hits.$topiccmt.$topiclike.$numberFile.$numberImg; ?></div>
	</div>
	<div class="pull-right span5">
		<div class="center"><?php echo $topiccatTitle.$seperator.$username; ?></div>
	</div><div class="clearfix"></div>
	<div style="border: solid 1px #dddddd; padding: 20px 10px 20px 10px;"><?php echo $item->body; ?></div>
</fieldset>



<?php if($existImg) : ?>
<div align="center" style="margin: 10px;">
	<a href="<?php echo JUri::base() . $imgs['img']; ?>" target="_new">
		<img class="media-object thumbnail" src="<?php echo JUri::base() . $imgs['imgthumb']; ?>" alt="" />
	</a>
</div>
<?php endif; ?>

<?php if($existFile) : ?>
<div>
	<a href="<?php echo JUri::base() . $files['file']; ?>"><?php echo basename($files['file']); ?></a>
</div>
<?php endif; ?>