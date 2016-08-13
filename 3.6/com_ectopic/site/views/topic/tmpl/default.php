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
$urlPlural = JRoute::_('?option='.$optionCom.'&view='.$nameKey
	.'s&&topiccat='.$topiccat.'&Itemid='.$itemId);

$modified = EcDatetime::interval($item->modified);
$title = $item->title;
$imgs = json_decode($item->imgs, true); //EcDebug::lp(count($imgs));
$existImg =  ((count($imgs)) && (array_key_exists('img', $imgs)) && (!empty($imgs['img'])));
$username = '<a href="'.JRoute::_('?option=com_ecuser&view=user&user='
	.$item->user).'">'.$item->username.'</a>';
$hits = JText::sprintf('COM_ECTOPIC_TOPICS_HITS', $item->hits);
$topiccmt = JText::sprintf('COM_ECTOPIC_TOPICS_TOPICCMT', $item->topiccmt);
$topiclike = JText::sprintf('COM_ECTOPIC_TOPICS_TOPICLIKE', $item->topiclike);
$topiccatTitle = JHtml::_('string.truncateComplex', $item->topiccatTitle, 15);

$seperator = '&nbsp;&middot;&nbsp;';

$availableEdit = (1) ? true : false;
$availableDelete = (1) ? true : false;



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

	
	
if(isset($item->event->beforeDisplay)) echo $item->event->beforeDisplay;

echo '<fieldset><legend>'.$title.'</legend>';
		echo '<div class="pull-left span5">';
			echo '<div class="center">'.$modified.$seperator.$hits.$seperator.$topiccmt.$seperator.$topiclike.'</div>';
		echo '</div>';
		echo '<div class="pull-right span5">';
			echo '<div class="center">'.$topiccatTitle.$seperator.$username.'</div>';
		echo '</div><div class="clearfix"></div>';
	echo '<div style="border: solid 1px #dddddd; padding: 10px;">'.nl2br($item->body).'</div>';
echo '</fieldset>';

if(isset($item->event->afterDisplay)) echo $item->event->afterDisplay;