<?php /** @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');

//TODO reformatting



$nameCol = $nameKey; //switch
$valueCol = $valueKey;
$nameKey = $nameCol.'cmt';
$valueKey = 0;



echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
	.$nameKey.'_'.$valueKey.'" class="form-validate form-horizontal">';
	
	if(is_object($this->topiccmtForm)) {
		foreach ($this->topiccmtForm->getFieldset('topiccmt') as $field) {
			if($field->name == 'jform[body]') {
				$body = (EcPermit::allowAdd()) ? str_replace('readonly ', '', $field->input) : $field->input;
				echo str_replace('<textarea', '<textarea style="width: 98%;"', $body);
			} else echo $field->input;
		}
	}
	
	echo '<div style="margin: 10px 0px 30px 0px;"><span style="float:right"><div class="btn-group">';
		$params = array('optionCom' => $optionCom, 'nameKey' => $nameKey);
		$params['task'] = 'save'; //validate is false: use submitform instead of submitbutton
		$params['disable'] = !(EcPermit::allowAdd());
		echo EcBtn::submit($params); //EcDebug::lp($params);
	echo '</div></span></div>';

	echo '<input type="hidden" name="jform['.$nameCol.']" value="'.$valueCol.'" />';
	echo '<input type="hidden" name="task" value="" />';
	echo JHtml::_('form.token');
echo '</form>'; //EcDebug::lp($params);