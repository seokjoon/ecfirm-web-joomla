<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');

//TODO reformatting



JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');



echo '<form action="'.JRoute::_(JUri::getInstance())
	.'" method="post" name="adminForm" id="adminForm">';
	if(!empty($this->sidebar))	echo '<div id="j-sidebar-container" class="span2">'
		.$this->sidebar.'</div><div id="j-main-container" class="span10">';
	else echo '<div id="j-main-container">';
	echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
	if(empty($this->items)) {
		echo '<div class="alert alert-no-items">';
			echo JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS');
		echo '</div>'; 
	} else {
		echo '<table class="table table-striped" id="articleList">';
			echo '<thead><tr>';
				echo '<th width="1%" class="center">';
					echo JHtml::_('grid.checkall');
				echo '</th>';
				echo '<th class="center">';
					echo JText::_('COM_ECTOPIC_TOPIC_TITLE_HEADER');
				echo '</th>';
				echo '<th class="center">';
					echo JText::_('COM_ECTOPIC_TOPIC_USER_HEADER');
				echo '</th>';
			echo '</tr></thead>';
			echo '<tbody>';
			foreach($this->items as $i => $item)	{
				echo '<tr class="row'.($i % 2).'" sortable-group-id="'.$item->topic.'">';
					echo '<td class="center hidden-phone">';
						echo JHtml::_('grid.id', $i, $item->topic);
					echo '</td>';
					echo '<td class="has-context">';
						echo '<a href="'.JRoute::_
							('index.php?option=com_ectopic&task=topic.edit&topic='
							.$item->topic).'" title="'.JText::_('JACTION_EDIT').'">';
							echo $item->title.'</a>';
					echo '</td>';
					echo '<td class="center hidden-phone">';
						echo $item->username;
					echo '</td>';
				echo '</tr>';
			}
			echo '</tbody>';
		echo '</table>';
	}
	echo $this->pagination->getListFooter();
	echo '<input type="hidden" name="task" value="" />';
	echo '<input type="hidden" name="boxchecked" value="0" />';
	echo JHtml::_('form.token');
	echo '</div>';
echo '</div>';
echo '</form>';