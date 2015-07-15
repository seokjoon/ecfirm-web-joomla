<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$icUser = 'media/com_ec/images/ic_user-48.png';
$item = $this->item;
$nameKey = $this->nameKey;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;
$optionCom = JFactory::getApplication()->input->get('option');



echo '<div id="" class="well well-small">';
	echo '<form action="" method="" id="">';



	if(is_object($this->form)) foreach(($this->form->getFieldset('prod')) as $field)
		echo $field->input;


		echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'" />';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form>';
echo '</div>';