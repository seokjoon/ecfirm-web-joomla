<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$icUser = 'media/com_ec/images/ic_user-48.png';
$nameKey = $this->nameKey;
$optionCom = JFactory::getApplication()->input->get('option');



require JPATH_COMPONENT.'/views/'.$nameKey.'/tmpl/default_addPre.php';



echo '<div id="'.$nameKey.'_list">';
if(!empty($this->items)) 
	foreach ($this->items as $item) 
		require JPATH_COMPONENT.'/views/'.$nameKey.'/tmpl/default_item.php';
echo '</div>';



if ($this->pagination->pagesTotal > 1)	{
echo '<div class="pagination">';
	echo '<p class="counter pull-right">'
		.$this->pagination->getPagesCounter().'</p>';
	echo $this->pagination->getPagesLinks();
echo '</div>'; }