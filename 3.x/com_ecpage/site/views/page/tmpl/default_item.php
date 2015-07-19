<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$valueKey = (is_object($item)) ? $item->$nameKey : 0; //EcDebug::lp($item);
$availableEdit = (1) ? true : false;
$availableDelete = (1) ? true : false;
$intro = nl2br(JHtml::_('string.truncateComplex', $item->body, 80));
$sizeIntro = JString::strlen($intro);
$sizeBody = JString::strlen($item->body); //EcDebug::lp($sizeIntro); EcDebug::lp($sizeBody);
$body = ($sizeIntro < $sizeBody) ?
$intro.EcWidget::spanReadmore($item->body) : $intro;
$modified = EcDatetime::interval($item->modified);



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well well-small">';
	if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;



	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical">';
			
		echo '<div class="pull-left" style="width:80%" align="left">';
			echo '<div class="pull-left media" style="margin-right:10px;">';
				echo '<a href="">';
					echo '<img class="media-object thumbnail" src="'.$icPage.'" alt="">';
				echo '</a>';
			echo '</div>';
			echo '<div class="media-body">';
				echo '<div>'.$item->user.'</div>';
				echo '<div>'.$item->modified.'</div>';
				echo '<div>'.$title.'</div>';
				echo '<div>'.$body.'</div>';
			echo '</div>';
		echo '</div>';	

		echo '<div class="pull-right" style="width:20%" align="right">';
			echo '<div class="btn-group">';
				echo EcageWidget::caretBtn(false);
				echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
					$params['nameCols'] = array('page', 'user');
					$params['optionCom'] = $optionCom;
					$params['nameKey'] = $nameKey;
					$params['valueKey'] = $valueKey;
					$params['task'] = 'edit';
					$params['idPostfix'] = 'form';
					$params['post'] = true;
					if($availableEdit) echo EcpageWidget::submitBtnLi($params);
					echo '<li class="divider"></li>';
					$params['task'] = 'delete';
					if($availableDelete) echo EcpageWidget::submitBtnLi($params);
				echo '</ul>';
			echo '</div>';
		echo '</div>'; //EcDebug::lp($params);
	
		

		echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'">';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form><div class="clearfix"></div>';
	
	
	
	//echo '<div id="'.$nameKey.'_'.$valueKey.'_body">'.$item->body.'</div>';
	//echo '<div id="'.$nameKey.'_'.$valueKey.'_img"></div>';

	
	
	if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;
echo '</div>';