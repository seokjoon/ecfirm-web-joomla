<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$icUser = 'media/com_ec/images/ic_user_48.png';
$icProd = 'media/com_ec/images/ic_prod_128.png';
$nameKey = $this->nameKey;
$optionCom = $this->optionCom;



echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" '
	.'id="'.$nameKey.'_0_item" class="form-validate">';
	echo '<div class="pull-right">';
		$params['nameCols'] = array();
		$params['optionCom'] = $optionCom;
		$params['nameKey'] = $nameKey;
		$params['valueKey'] = 0;
		$params['task'] = 'add';
		$params['idPostfix'] = 'item';
		$params['post'] = true;
		echo EcWidget::submitBtn($params);
	echo '</div><div class="clearfix"></div>';
	echo '<input type="hidden" name="task" value="" />';
echo '</form>';



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