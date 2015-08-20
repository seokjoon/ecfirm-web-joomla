<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



echo '<div class="tab-pane" id="'.$this->nameKey.'_0_img">';
	echo '<form action="'.(JUri::getInstance()->toString())
		.'" method="post" id="" class="" enctype="multipart/form-data">';
		
		foreach($this->form->getFieldset('img') as $field) {
			//echo '<span>'.$field->label.'</span>';
			echo str_replace('jform_img_url"', 'jform_img_url" placeholder="'
				.JText::_('COM_ECMSG_MSG_IMG_URL').'" style="width:96%"', $field->input);
		}
		
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';

echo '</div>';