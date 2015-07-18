<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$icUser = 'media/com_ec/images/ic_user-48.png';
$optionCom = $this->optionCom;



echo '<div id="'.$nameCol.'_'.$valueCol.'_'.$this->getName().'_list">';
	require JPATH_COMPONENT.'/views/'.$nameKey.'/tmpl/default_add.php';
	if(!empty($this->items))
		foreach($this->items as $item)
			require JPATH_COMPONENT.'/views/'.$nameKey.'/tmpl/default_item.php';
echo '</div>';