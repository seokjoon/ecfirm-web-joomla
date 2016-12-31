<?php
/** 
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. 
 */
defined('_JEXEC') or die('Restricted access');
?>



<div style="margin-top: 50px;">
	<?php
	if (empty($this->topiccmts))
		echo '<div class="alert alert-no-items">' . JText::_('COM_ECTOPIC_NO_MATCHING_RESULTS') . '</div>';
	else
		foreach ($this->topiccmts as $topiccmt)
			require 'default_topiccmt.php';
	?>
</div>

<?php echo $this->topiccmtsPagination->getListFooter(); ?>