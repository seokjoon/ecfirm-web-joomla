<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$nameKey = $this->nameKey;
$optionCom = $this->optionCom;



echo '<form action="'.(JUri::getInstance()->toString()).'" method="post" '
	.'id="'.$nameKey.'_0_item" class="form-validate">';
	echo '<div class="pull-right">';
		$params['nameCols'] = array();
		$params['optionCom'] = $optionCom;
		$params['nameKey'] = $nameKey;
		$params['valueKey'] = 0;
		$params['task'] = 'add';
		$params['idPostfix'] = 'item';
		$params['post'] = true;
		echo EcWidget::submitBtn($params);
	echo '</div><div class="clearfix"></div>';
	echo '<input type="hidden" name="task" value="" />';
echo '</form>';



JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');



echo '<form action="'.JRoute::_('index.php?option=com_psprop&view=props')
	.'" method="post" name="adminForm" id="adminForm">';
	echo '<div id="j-main-container">';
		//echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		if(empty($this->items)) {
			echo '<div class="alert alert-no-items">';
				echo JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS');
			echo '</div>';
		} else {
			echo '<table class="table table-striped" id="articleList">';
				echo '<thead><tr>';
					echo '<th class="has-context">';
						echo JText::_('COM_ECTOPIC_TOPIC_TITLE_HEADER');
					echo '</th>';
					echo '<th class="center hidden-phone">';
						echo JText::_('COM_ECTOPIC_TOPIC_USERNAME_HEADER');
					echo '</th>';
				echo '</tr></thead>';
				echo '<tbody>';
				foreach($this->items as $i => $item)	{
					echo '<tr class="row'.($i % 2).'" sortable-group-id="'.$item->prop.'">';
						echo '<td class="">';

								echo $item->title;

						echo '</td>';

						echo '</td>';

							echo $item->username;

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