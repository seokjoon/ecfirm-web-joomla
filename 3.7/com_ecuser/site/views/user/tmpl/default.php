<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$item = $this->item; //EcDebug::lp($item);
$optionCom = $this->optionCom;
$nameKey = $this->nameKey;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;

$seperator = '&nbsp;&middot;&nbsp;';
if(isset($item->imgs)) $imgs = json_decode($item->imgs, true);



if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;



echo '<div class="pull-right">';
	echo '<form action="'.JRoute::_(JUri::getInstance()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical">';
	
		echo '<div class="pull-left" style="" align="left"></div>';
		
		echo '<div class="pull-right" style="" align="right">';
			echo '<div class="btn-group">';
				$params = array('optionCom' => $optionCom, 'nameKey' => $nameKey,
					'valueKey' => $valueKey, 'idPostfix' => 'form');
				$params['disable'] = !($this->getAllow()['edit']); 
				$params['task'] = 'editProfile';
				echo EcBtn::submit($params);			
				echo EcBtn::caret(true);
				echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
					$params['task'] = 'editAccount';
					echo EcBtn::submitLi($params);
					$params['task'] = 'logout';
					echo EcBtn::submitLi($params);
					echo '<li class="divider"></li>';
					$params['task'] = 'delete';
					echo EcBtn::submitLi($params);
				echo '</ul>';
			echo '</div>';
		echo '</div>'; //EcDebug::lp($params);
		
		echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'">';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form><div class="clearfix"></div>';
echo '</div>';



echo '<div class="form-horizontal">';
	echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active'=>'user'));
		echo JHtml::_('bootstrap.addTab', 'myTab', 'user', JText::_('COM_ECUSER_USER_TAB_USER'));
			require_once 'default_user.php';
		echo JHtml::_('bootstrap.endTab');
	echo JHtml::_('bootstrap.endTabSet');
echo '</div>';



if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;