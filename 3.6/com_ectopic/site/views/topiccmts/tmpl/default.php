<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



echo '<div>&nbsp;</div>';
echo '<form action="'.JRoute::_(JUri::getInstance())
	.'" method="post" name="adminForm" id="adminForm">';
	echo '<div id="j-main-container">';
		//echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		if(empty($this->items)) {
			echo '<div class="alert alert-no-items">';
				echo JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS');
			echo '</div>';
		} else require JPATH_COMPONENT.'/views/topic/tmpl/default_topiccmt.php';
		//echo $this->pagination->getListFooter();
		echo '<input type="hidden" name="task" value="" />';
		echo '<input type="hidden" name="boxchecked" value="0" />';
		echo JHtml::_('form.token');
	echo '</div>';
echo '</form>';



if ($this->topiccmtsPagination->pagesTotal > 1)	{
	echo '<div class="pagination">';
		echo '<p class="counter pull-right">'.$this->topiccmtsPagination->getPagesCounter().'</p>';
		echo $this->topiccmtsPagination->getPagesLinks();
	echo '</div>';
}