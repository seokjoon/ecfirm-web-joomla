<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



//EcDebug::lp($this->formCmt);
foreach ($this->formCmt->getFieldset('topiccmt') as $field) {

	echo $field->label;
	echo $field->input;
	
}