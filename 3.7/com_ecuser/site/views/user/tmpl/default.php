<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$item = $this->item; EcDebug::lp($item);
$optionCom = $this->optionCom;
$nameKey = $this->nameKey;
$valueKey = (is_object($item)) ? $item->$nameKey : 0;

if(isset($item->imgs)) $imgs = json_decode($item->imgs, true);



if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;



echo '<div class="pull-right">';
	echo '<form action="'.JRoute::_(JUri::getInstance()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical">';
	
		echo '<div class="pull-left" style="" align="left">';
			echo '<div>'.JText::sprintf('COM_PSUSER_USER_WELCOME_NAME', 
				$item->name.'('.$item->email.')').'</div>';
			echo '<div>&nbsp;<span class=icon-ok></span>&nbsp;'
				.JText::sprintf('COM_PSUSER_USER_MODIFIED_BOFORE', $modified).'</div>';
		echo '</div>';
		
		echo '<div class="pull-right" style="" align="right">';
			echo '<div class="btn-group">';
				$params = array('optionCom' => $optionCom, 'nameKey' => $nameKey,
					'valueKey' => $valueKey, 'idPostfix' => 'form');
				//$params['disable'] = $this->getAllow('edit');
				$params['task'] = 'edit';
				echo EcBtn::submit($params);			
				echo EcBtn::caret(true);
				echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
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



if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;