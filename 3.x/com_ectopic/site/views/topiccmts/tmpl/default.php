<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$optionCom = $this->optionCom;



echo '<div id="'.$nameCol.'_'.$valueCol.'_'.$this->getName().'_list">';
	require JPATH_COMPONENT.'/views/'.$nameKey.'/tmpl/default_add.php';
	if(!empty($this->items))
		foreach($this->items as $item)
			require JPATH_COMPONENT.'/views/'.$nameKey.'/tmpl/default.php';
echo '</div>';