<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



//JHtml::_('behavior.calendar');
//JHtml::_('behavior.formvalidator');
//JHtml::_('formbehavior.chosen', 'select');



$availableTask = (1) ? true : false;
//$task = 'add';
echo '<div id="'.$this->nameKey.'_0"><fieldset>';
	
	
	
	echo '<ul class="nav nav-tabs">';
		echo '<li class="active"><a href="#'.$this->nameKey
			.'_0_body" data-toggle="tab">'.JText::_('COM_ECMSG_MSG').'</a></li>';
		echo '<li><a href="#'.$this->nameKey.'_0_img" data-toggle="tab">'
			.JText::_('COM_ECMSG_MSG_IMG').'</a></li>';
		echo '<li><a href="#'.$this->nameKey.'_0_video" data-toggle="tab">'
			.JText::_('COM_ECMSG_MSG_VIDEO').'</a></li>';
	echo '</ul>';
	
		
	
	echo '<div class="tab-content">';
		require_once 'default_edit.php';
		require_once 'default_editImg.php';
		require_once 'default_editVideo.php';
	echo '</div>';

	

echo '</fieldset></div>';