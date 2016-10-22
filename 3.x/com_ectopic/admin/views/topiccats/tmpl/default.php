<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$urlForm = JRoute::_(JUri::getInstance());
?>



<form action="<?php echo $urlForm; ?>" method="post" name="adminForm"
	id="adminForm">
	
	<?php if(!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2"><?php echo $this->sidebar; ?></div>
	<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
	<?php endif; ?>

		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
	
		<?php if(empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS'); ?>	
		</div>
		<?php else : ?>
		
		<table class="table table-striped" id="articleList">
		
			<thead>
				<tr>
					<th width="1%" class="center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th class="center">
						<?php echo JText::_('COM_ECTOPIC_TOPICCAT_TITLE_HEADER'); ?>
					</th>
					<th class="center">
						<?php echo JText::_('COM_ECTOPIC_TOPICCAT_STATE_HEADER'); ?>
					</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
				<tr class="row<?php echo ($i % 2)?>" sortable-group-id="<?php echo $item->topiccat; ?>">
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->topiccat); ?>
					</td>
					<td class="has-context">
						<a href="<?php echo JRoute::_('index.php?option=com_ectopic&task=topiccat.edit&topiccat=').$item->topiccat; ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>"><?php echo $item->title; ?></a>
					</td>
					<td class="center hidden-phone">
						<?php 
						$stateValues = NsHelperCardcat::getStateValues();
						echo $stateValues[$item->state];
						?>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>

		</table>
		<?php endif; ?>
		
		<?php echo $this->pagination->getListFooter(); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>	

	</div>

</form>