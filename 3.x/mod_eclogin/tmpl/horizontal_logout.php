<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



JLoader::register('EcUrl', JPATH_SITE . '/components/com_ec/helpers/ecUrl.php');
JHtml::_('behavior.keepalive');

$user = JFactory::getUser();
$itemId = EcUrl::getItemIdCom('com_ecuser');
$urlFormAction = JRoute::_(htmlspecialchars(JUri::getInstance()->toString(), 
	ENT_COMPAT, 'UTF-8'), true, $params->get('usesecure'));
$urlUser = JRoute::_('index.php?option=com_ecuser&view=user&user=' 
	. $user->id . '&Itemid=' . $itemId);
$userName = htmlspecialchars($user->get('name'), ENT_COMPAT, 'UTF-8');
$userName = JHtml::_('string.truncate', $userName, '20');
$msg = '<span class="label label-success">' . $userName . '</span>';
$msg = '<a href="'.$urlUser.'">'.$msg.'</a>';
$msg = JText::sprintf('MOD_ECLOGIN_MSG', $msg);
$lblLogout = JText::_('JLOGOUT');
?>



<form action="<?php $urlFormAction; ?>" method="post" id="login-form" class="form-horizontal">
	<div class="logout-button pull-right">
		<?php echo $msg; ?>
		<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo $lblLogout; ?>" />
		<input type="hidden" name="option" value="com_ecuser" />
		<input type="hidden" name="task" value="login.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div><div class="clearfix"></div>
</form>