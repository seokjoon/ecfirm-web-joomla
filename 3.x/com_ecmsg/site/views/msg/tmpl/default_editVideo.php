<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



echo '<div class="tab-pane" id="'.$this->nameKey.'_0_video">';
	echo '<form action="'.(JUri::getInstance()->toString())
		.'" method="post" id="" class="" enctype="multipart/form-data">';
		
		foreach($this->form->getFieldset('video') as $field) {
			//echo '<span>'.$field->label.'</span>';
			echo str_replace('jform_video_url"', 'jform_video_url" placeholder="'
				.JText::_('COM_ECMSG_MSG_VIDEO_URL').'" style="width:96%"', $field->input);
		}
		
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';

echo '</div>';



//echo '<iframe width="560" height="315" src="//www.youtube.com/embed/HvWM9ZcoxwQ" frameborder="0" allowfullscreen></iframe>';