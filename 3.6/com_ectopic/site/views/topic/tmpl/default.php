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
$urlPlural = JRoute::_('?option='.$optionCom.'&view='.$nameKey.'s&&topiccat='
	.$topiccat.'&Itemid='.$itemId);

$seperator = '&nbsp;&middot;&nbsp;';

$modified = EcDatetime::interval($item->modified);
$title = $item->title;
$username = '<a href="'.JRoute::_('?option=com_ecuser&view=user&user='
	.$item->user).'">'.$item->username.'</a>';
$hits = JText::sprintf('COM_ECTOPIC_TOPIC_HITS_NUMBER', $item->hits);
$topiccmt = ($item->topiccmt > 0) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_TOPICCMT_NUMBER', $item->topiccmt) : null;
$topiclike = ($item->topiclike) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_TOPICLIKE_NUMBER', $item->topiclike) : null;
$topiccatTitle = JHtml::_('string.truncateComplex', $item->topiccatTitle, 15);
$files = json_decode($item->files, true); //EcDebug::lp(count($files));
$imgs = json_decode($item->imgs, true); //EcDebug::lp(count($imgs));
$countFile = count($files);
$countImg = (count($imgs))/2;
$existFile =  (($countFile > 0) && (array_key_exists('file', $files)) && (!empty($files['file'])));
$existImg =  (($countImg > 0) && (array_key_exists('img', $imgs)) && (!empty($imgs['img'])));
$numberFile = ($existFile) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_FILE_NUMBER', $countFile) : null;
$numberImg = ($existImg) ? $seperator.JText::sprintf
	('COM_ECTOPIC_TOPIC_IMG_NUMBER', $countImg) : null;

$user = JFactory::getUser();



echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" id="'
	.$nameKey.'_'.$valueKey.'" class="form-validate">';
	echo '<div class="pull-right" align="right">';
		echo '<div class="btn-group">';
			echo '<a class="btn btn-default" href="'.$urlPlural.'">'
				.JText::_('COM_ECTOPIC_TOPICS').'</a>';
			echo EcBtn::caret(true);
			echo '<ul class="dropdown-menu" style="right:0px;left:auto;" role="menu">';
				$params = array('optionCom' => $optionCom, 'nameKey' => $nameKey);
				$params['valueKey'] = $valueKey;
				$params['task'] = 'edit';
				$params['disable'] = !($this->getAllow()['edit']);
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

	
	
echo '<div class="form-horizontal">';
	echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active'=>'topic'));
		echo JHtml::_('bootstrap.addTab', 'myTab', 'loan', 
			JText::_('COM_ECTOPIC_TOPIC_DISPLAY_TOPIC'));
			if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;
				require_once 'default_topic.php';
			if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;
		echo JHtml::_('bootstrap.endTab');
		echo JHtml::_('bootstrap.addTab', 'myTab', 'com', 
			JText::_('COM_ECTOPIC_TOPIC_DISPLAY_TOPICCMT').'('.$item->topiccmt.')');
			require_once 'edit_topiccmt.php';
			require_once 'default_topiccmts.php';
		echo JHtml::_('bootstrap.endTab');
	echo JHtml::_('bootstrap.endTabSet');
echo '</div>';