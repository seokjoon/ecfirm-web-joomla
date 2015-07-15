<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$valueKey = $item->$nameKey;

	

$availableEdit = (1) ? true : false;
$availableDelete = (1) ? true : false;
$availableImg = (1) ? true : false; 
$intro = nl2br(JHtml::_('string.truncateComplex', $item->body, 80));
$sizeIntro = JString::strlen($intro);
$sizeBody = JString::strlen($item->body); //EcDebug::lp($sizeIntro); EcDebug::lp($sizeBody);
$body = ($sizeIntro < $sizeBody) ? 
	$intro.EcWidget::spanReadmore($item->body) : $intro;
$modified = EcDatetime::interval($item->modified);
$juName = JHtml::_('string.abridge', $item->ju_name, 10, 3);
echo '<div id="'.$nameKey.'_'.$valueKey.'_item" class="well well-small">'; 
	if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;
	


	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" '
		.'id="'.$nameKey.'_'.$valueKey.'_form">';
	
		echo '<div class="pull-left" style="width:80%" align="left">';
			echo '<div class="pull-left media" style="margin-right:10px;">';
				echo '<a href="">';
					echo '<img class="media-object thumbnail" src="'.$icUser.'" alt="">';
				echo '</a>';
			echo '</div>';
			echo '<div class="media-body">';
				echo '<div>'.$juName.'</div>';
				echo '<div>'.$modified.'</div>';
			echo '</div>';
		echo '</div>';	

		echo '<div class="pull-right" style="width:20%" align="right">';
			echo '<div class="btn-group">';
				echo EcWidget::btnCaret(false);
				echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
					if($availableEdit) echo EcWidget::btnLiSubmit($optionCom, 
						$nameKey, $valueKey, array('body'), '', 'edit', false);
					echo '<li class="divider"></li>';
					if($availableDelete) echo EcWidget::btnLiSubmit($optionCom, 
						$nameKey, $valueKey, array(''), 'item', 'delete', false);
				echo '</ul>';
			echo '</div>';
		echo '</div>';
	
		echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'" />';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form><div class="clearfix"></div>';

	

	echo '<div id="'.$nameKey.'_'.$valueKey.'_body">'.$body.'</div>';
	echo '<div id="'.$nameKey.'_'.$valueKey.'_img"></div>';
	
	

	if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;
echo '</div>'; //EcDebug::lp($item);