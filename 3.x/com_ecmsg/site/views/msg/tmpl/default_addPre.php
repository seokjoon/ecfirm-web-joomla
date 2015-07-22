<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



echo '<div id="'.$this->nameKey.'_0">';
	echo EcmsgWidget::textareaSubmit($this->optionCom, $this->nameKey, 0, 
		array(''), 'item', 'add', false, false);
echo '</div>';