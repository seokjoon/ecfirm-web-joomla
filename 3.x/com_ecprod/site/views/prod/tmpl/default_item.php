<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$valueKey = (is_object($item)) ? $item->$nameKey : 0; //EcDebug::lp($item);



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well well-small">';
	if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;



	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical">';
			
		echo '<div class="pull-left" style="width:80%" align="left">';
			echo '<div class="pull-left media" style="margin-right:10px;">';
				echo '<a href="">';
					echo '<img class="media-object thumbnail" src="'.$icTag.'" alt="">';
				echo '</a>';
			echo '</div>';
			echo '<div class="media-body">';
				echo '<div>'.$item->user.'</div>';
				echo '<div>'.$item->modified.'</div>';
			echo '</div>';
		echo '</div>';	

		echo '<div class="pull-right" style="width:20%" align="right">';
			echo '<div class="btn-group">';
				echo EcprodWidget::caretBtn(false);
				echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
					if($availableEdit) echo EcWidget::btnLiSubmit($optionCom, 
						$nameKey, $valueKey, array('body'), '', 'edit', false);
					echo '<li class="divider"></li>';
					if($availableDelete) echo EcWidget::btnLiSubmit($optionCom, 
						$nameKey, $valueKey, array(''), 'item', 'delete', false);
				echo '</ul>';
			echo '</div>';
		echo '</div>';
	
	
		$params['nameCols'] = array();
		

		
		
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form><div class="clearfix"></div>';
	
	
	
	echo '<div id="'.$nameKey.'_'.$valueKey.'_body">'.$item->body.'</div>';
	echo '<div id="'.$nameKey.'_'.$valueKey.'_img"></div>';

	
	
	if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;
echo '</div>';