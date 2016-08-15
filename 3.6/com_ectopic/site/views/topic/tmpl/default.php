<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$item = $this->item; //EcDebug::lp($item);
$optionCom = $this->optionCom; 
$nameKey = $this->nameKey; 
$valueKey = (is_object($item)) ? $item->$nameKey : 0; 

$topiccat = EctopicUrl::getTopiccat();
$itemId = EcUrl::getItemId();
$urlPlural = JRoute::_('?option='.$optionCom.'&view='.$nameKey.'s&&topiccat='.$topiccat.'&Itemid='.$itemId);

$seperator = '&nbsp;&middot;&nbsp;';

$modified = EcDatetime::interval($item->modified);
$title = $item->title;
$username = '<a href="'.JRoute::_('?option=com_ecuser&view=user&user='
	.$item->user).'">'.$item->username.'</a>';
$hits = JText::sprintf('COM_ECTOPIC_TOPIC_HITS_NUMBER', $item->hits);
$topiccmt = ($item->topiccmt > 0) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_TOPICCMT_NUMBER', $item->topiccmt) : null;
$topiclike = ($item->topiclike) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_TOPICLIKE_NUMBER', $item->topiclike) : null;
$topiccatTitle = JHtml::_('string.truncateComplex', $item->topiccatTitle, 15);
$files = json_decode($item->files, true); //EcDebug::lp(count($files));
$imgs = json_decode($item->imgs, true); //EcDebug::lp(count($imgs));
$countFile = count($files);
$countImg = (count($imgs))/2;
$existFile =  (($countFile > 0) && (array_key_exists('file', $files)) && (!empty($files['file'])));
$existImg =  (($countImg > 0) && (array_key_exists('img', $imgs)) && (!empty($imgs['img'])));
$numberFile = ($existFile) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_FILE_NUMBER', $countFile) : null;
$numberImg = ($existImg) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_IMG_NUMBER', $countImg) : null;

$user = JFactory::getUser();
$availableAdd = (1) ? true : false;
$availableEdit = (1) ? true : false;
$availableDelete = (1) ? true : false;
$availableAddCmt = (1) ? true : false;
$availableAddDelete = (1) ? true : false;



echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
	.$nameKey.'_'.$valueKey.'_form" class="form-validate">';
	echo '<div class="pull-right" align="right">';
		echo '<div class="btn-group">';
			echo '<a class="btn btn-default" href="'.$urlPlural.'">'.JText::_('COM_ECTOPIC_TOPICS').'</a>';
			echo EcWidget::caretBtn(true);
			echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
				$params['nameCols'] = array('', 'user');
				$params['optionCom'] = $optionCom;
				$params['nameKey'] = $nameKey;
				$params['valueKey'] = $valueKey;
				$params['idPostfix'] = 'form';
				$params['post'] = true;
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

	
	
echo '<div class="form-horizontal">';
	echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active'=>'topic'));
		echo JHtml::_('bootstrap.addTab', 'myTab', 'loan', JText::_('COM_ECTOPIC_TOPIC_DISPLAY_TOPIC', true));
			if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;
				require_once 'default_topic.php';
			if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;
		echo JHtml::_('bootstrap.endTab');
		echo JHtml::_('bootstrap.addTab', 'myTab', 'com', JText::_('COM_ECTOPIC_TOPIC_DISPLAY_TOPICCMT', true));
			require_once JPATH_COMPONENT.'/views/topiccmt/tmpl/edit.php';
			require_once JPATH_COMPONENT.'/views/topiccmts/tmpl/default.php';
		echo JHtml::_('bootstrap.endTab');
	echo JHtml::_('bootstrap.endTabSet');
echo '</div>';