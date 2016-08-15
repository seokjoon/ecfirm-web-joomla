<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



echo '<div style="margin-top: 50px;">';
	//echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
	if(empty($this->topiccmts)) {
		echo '<div class="alert alert-no-items">';
			echo JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS');
		echo '</div>';
	} else foreach ($this->topiccmts as $topiccmt) 
		require JPATH_COMPONENT.'/views/topiccmt/tmpl/default.php';
echo '</div>';
//echo $this->pagination->getListFooter();



if ($this->topiccmtsPagination->pagesTotal > 1)	{
	echo '<div class="pagination">';
		echo '<p class="counter pull-right">'.$this->topiccmtsPagination->getPagesCounter().'</p>';
		echo $this->topiccmtsPagination->getPagesLinks();
	echo '</div>';
}