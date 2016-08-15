<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



//EcDebug::lp($this->topiccmtForm);
foreach ($this->topiccmtForm->getFieldset('topiccmt') as $field) {
	if($field->name == 'jform[body]') {
		$body = ($availableAddCmt) ? str_replace('readonly ', '', $field->input) : $field->input;
		echo str_replace('<textarea', '<textarea style="width: 98%;"', $body);
	} else echo $field->input;
}