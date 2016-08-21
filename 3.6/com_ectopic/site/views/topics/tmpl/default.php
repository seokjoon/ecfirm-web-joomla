<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select'); 



$nameKey = $this->nameKey;
$optionCom = $this->optionCom;
$topiccat = EctopicUrl::getTopiccat();
$itemId = EcUrl::getItemId();
$topiccatTitle = JHtml::_('string.truncateComplex', $this->topiccatTitle, 30);
$topiccatBody = nl2br($this->topiccatBody);
$seperator = '&nbsp;&middot;&nbsp;';



echo '<form action="'.JRoute::_(JUri::getInstance()).'" method="post" '
	.'id="'.$nameKey.'_0" class="form-validate">';
	echo '<div class="pull-right">';
		$params = array('optionCom' => $optionCom, 'nameKey' => $nameKey, 
			'task' => 'add', 'disable' => !($this->getAllow()['add']));
		echo EcBtn::submit($params);
	echo '</div><div class="clearfix"></div>';
	echo '<input type="hidden" name="task" value="" />';
echo '</form>';



echo '<fieldset><legend>'.$topiccatTitle.'</legend><small>'.$topiccatBody.'</small></fieldset>';



echo '<form action="'.JRoute::_(JUri::getInstance())
	.'" method="post" name="adminForm" id="adminForm">';
	echo '<div id="j-main-container">';
		echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		if(empty($this->items)) {
			echo '<div class="alert alert-no-items">';
				echo JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS');
			echo '</div>';
		} else {
			echo '<table class="table table-striped" id="articleList">';
				echo '<thead><tr>';
					echo '<th class="center span6">';
						echo JText::_('COM_ECTOPIC_TOPICS_TITLE_HEADER');
					echo '</th>';
					echo '<th class="center hidden-phone span4">';
						echo JText::_('COM_ECTOPIC_TOPICS_USERNAME_HEADER');
					echo '</th>';
				echo '</tr></thead>';
				echo '<tbody>';
				foreach($this->items as $i => $item)	{ //EcDebug::lp($item);
					$title = JHtml::_('string.truncateComplex', $item->title, 40);
					$title = '<a href="'.JRoute::_('?option='.$optionCom.'&view=' .$nameKey
						.'&'.$nameKey.'='.$item->topic.'&topiccat='.$topiccat.'&Itemid='.$itemId).'">'.$title.'</a>';
					$modified = EcDatetime::interval($item->modified);
					$username = '<a href="'.JRoute::_('?option=com_ecuser&view=user&user='
						.$item->user).'">'.$item->username.'</a>';
					$hits = JText::sprintf('COM_ECTOPIC_TOPIC_HITS_NUMBER', $item->hits);
					$topiccmt = ($item->topiccmt > 0) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_TOPICCMT_NUMBER', $item->topiccmt) : null;
					$topiclike = ($item->topiclike) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_TOPICLIKE_NUMBER', $item->topiclike) : null;
					$files = json_decode($item->files, true); //EcDebug::lp(count($files));
					$imgs = json_decode($item->imgs, true); //EcDebug::lp(count($imgs));
					$countFile = count($files);
					$countImg = (count($imgs))/2;
					$existFile =  (($countFile > 0) && (array_key_exists('file', $files)) && (!empty($files['file'])));
					$existImg =  (($countImg > 0) && (array_key_exists('img', $imgs)) && (!empty($imgs['img'])));
					$numberFile = ($existFile) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_FILE_NUMBER', $countFile) : null;
					$numberImg = ($existImg) ? $seperator.JText::sprintf('COM_ECTOPIC_TOPIC_IMG_NUMBER', $countImg) : null;

					echo '<tr class="row'.($i % 2).'" sortable-group-id="'.$item->topic.'">';
						echo '<td class="has-context">';
							echo '<div>'.$title.'</div>';
							echo '<div><small>'.$modified.$seperator.$hits.$topiccmt.$topiclike.$numberFile.$numberImg.'</small></div>';
						echo '</td>';
						echo '<td class="center hidden-phone">';
							echo '<div>'.$username.'</div>';
							echo '<div><small>'.'</small></div>';
						echo '</td>';
					echo '</tr>';
				}
				echo '</tbody>';
			echo '</table>';
		}
		//echo $this->pagination->getListFooter();
		echo '<input type="hidden" name="task" value="" />';
		echo '<input type="hidden" name="boxchecked" value="0" />';
		echo JHtml::_('form.token');
	echo '</div>';
echo '</form>';



if ($this->pagination->pagesTotal > 1)	{
	echo '<div class="pagination">';
		echo '<p class="counter pull-right">'.$this->pagination->getPagesCounter().'</p>';
		echo $this->pagination->getPagesLinks();
	echo '</div>';
}