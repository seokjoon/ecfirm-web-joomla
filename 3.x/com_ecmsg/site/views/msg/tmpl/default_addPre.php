<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



echo '<div id="'.$this->nameKey.'_0">';
	$params['optionCom'] = $this->optionCom;
	$params['nameKey'] = $this->nameKey;
	$params['valueKey'] = 0;
	$params['task'] = 'add';
	$params['post'] = false;
	$params['validate'] = false;
	echo EcWidget::submitTextarea($params);
echo '</div>';