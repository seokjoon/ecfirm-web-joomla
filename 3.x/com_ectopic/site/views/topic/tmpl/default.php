<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$item = $this->item;



$valueKey = (is_object($item)) ? $item->$nameKey : 0; //EcDebug::lp($item);
$availableEdit = (1) ? true : false;
$availableDelete = (1) ? true : false;
$modified = EcDatetime::interval($item->modified);
$body = nl2br($item->body);
$title = $item->title;
$imgs = json_decode($item->imgs, true); //EcDebug::lp(count($imgs));
$boolImgs = (count($imgs) > 1) ? true : false;
$thumbTopic = ($boolImgs) ? //JUri::base().$imgs['thumb'] :
	EctopicConst::IC_TOPIC_ABSTRACT_IMG : EctopicConst::IC_TOPIC_ABSTRACT;
$thumbTopicLink = JRoute::_('?option='.$optionCom.'&view='.$nameKey
	.'s&task='.$nameKey.'s.display&objcat='.EcUrl::getObjcat().'&Itemid='.EcUrl::getItemId());
$imgUser = EctopicConst::IC_TOPIC_USER;
$files = json_decode($item->files, true);
$boolFiles = (count($files) > 0) ? true : false;



echo '<div id="'.$nameKey.'_'.$valueKey.'" class="well well-small">';
	if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;
	
	echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
		.$nameKey.'_'.$valueKey.'_form" class="form-validate form-vertical">';

		echo '<div class="pull-left" style="width:94%" align="left">';
			echo '<div class="pull-left media" style="margin-right:10px;">';
				echo '<a href="'.$thumbTopicLink.'">';
					echo '<img class="media-object thumbnail" src="'.$thumbTopic.'" alt="">';
				echo '</a>';
			echo '</div>';
			echo '<div class="pull-left media" style="margin-right:10px;">';
				//echo '<a href="">';
				echo '<img class="media-object thumbnail" src="'.$imgUser.'" alt="">';
				//echo '</a>';
			echo '</div>';
			echo '<div class="media-body">';
				echo '<div>'.$title.'</div>';
				echo '<div>'.$item->ju_name.'&#160;'.$modified.'</div>';
				echo '<div style="padding-top: 8px;">'.$body.'</div>';
				if($boolImgs) echo '<div align="center" style="padding-top: 8px;"><a href="'
					.JUri::base().$imgs['img'].'"><img class="media-object thumbnail" src="'
					.JUri::base().$imgs['thumb'].'" alt=""></a></div>';
				if($boolFiles) echo '<div><a href="'
					.JUri::base().$files['file'].'">'.basename($files['file']).'</a></div>';
			echo '</div>';
		echo '</div>';	
	
		echo '<div class="pull-right" style="width:6%" align="right">';
			echo '<div class="btn-group">';
				echo EcWidget::caretBtn(false);
				echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
					$params['nameCols'] = array('topic', 'user');
					$params['optionCom'] = $optionCom;
					$params['nameKey'] = $nameKey;
					$params['valueKey'] = $valueKey;
					//$params['task'] = 'touch';
					$params['idPostfix'] = 'form';
					$params['post'] = true;
					//if($availableEdit) echo EcWidget::submitBtnLi($params);
					$params['task'] = 'edit';
					if($availableEdit) echo EcWidget::submitBtnLi($params);
					echo '<li class="divider"></li>';
					$params['task'] = 'delete';
					if($availableDelete) echo EcWidget::submitBtnLi($params);
				echo '</ul>';
			echo '</div>';
		echo '</div>'; //EcDebug::lp($params);

		echo '<input type="hidden" name="'.$nameKey.'" value="'.$valueKey.'">';
		echo '<input type="hidden" name="task" value="" />';
		echo JHtml::_('form.token');
	echo '</form><div class="clearfix"></div>';
	
	
	if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;
echo '</div>';