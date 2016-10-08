<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



JLoader::register('EcUrl', JPATH_SITE . '/components/com_ec/helpers/ecUrl.php');
JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

$config = JComponentHelper::getParams('com_users');
$availableRegister = $config->get('allowUserRegistration'); 
$disabledBtnRegister = ($availableRegister) ? null : ' disabled = "disabled"';
$itemId = EcUrl::getItemIdCom('com_ecuser');
$lblLogin = JText::_('JLOGIN');
$lblPassword = JText::_('JGLOBAL_PASSWORD');
$lblRememberMe = JText::_('MOD_ECLOGIN_REMEMBER_ME');
$lblRegister = JText::_('MOD_ECLOGIN_REGISTER_LABEL_SHORT');
$lblRemind = JText::_('MOD_ECLOGIN_REMIND_LABEL');
$lblReset = JText::_('MOD_ECLOGIN_RESET_LABEL');
$lblUsername = JText::_('MOD_ECLOGIN_USERNAME_LABEL');
$urlFormAction = JRoute::_('index.php?option=com_ecuser&view=user&task=login.useForm&Itemid='
	. $itemId, true, $params->get('usesecure'));
$urlRegister = ($availableRegister)
	? JRoute::_('index.php?option=com_ecuser&view=user&task=registration.useForm&Itemid=' . $itemId) 
	: 'javascript:;';
$urlRemind = JRoute::_('index.php?option=com_ecuser&view=user&task=remind.useForm&Itemid=' . $itemId);
$urlReset = JRoute::_('index.php?option=com_ecuser&view=user&task=reset.useForm&Itemid=' . $itemId);
$divStyle = 'style="padding: 0px 5px 0px 5px;"';
?>



<form action="<?php echo $urlFormAction ?>" method="post" id="login-form" class="form-inline">
	<div class="userdata pull-right">
	
		<div id="form-login-username" class="control-group pull-left" <?php echo $divStyle; ?>>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">
						<span class="icon-user hasTooltip" title="<?php echo $lblUsername; ?>"></span>
						<label for="modlgn-username" class="element-invisible"><?php echo $lblUsername; ?></label>
					</span>
					<input id="modlgn-username" type="text" name="username" class="input-small" tabindex="0" size="18" placeholder="<?php echo $lblUsername; ?>" />
				</div>
			</div>
		</div>
		
		<div id="form-login-password" class="control-group pull-left" <?php echo $divStyle; ?>>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">
						<span class="icon-lock hasTooltip" title="<?php echo $lblPassword; ?>">
						</span>
							<label for="modlgn-passwd" class="element-invisible"><?php echo $lblPassword; ?>
						</label>
					</span>
					<input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="0" size="18" placeholder="<?php echo $lblPassword; ?>" />
				</div>
			</div>
		</div>
		
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div id="form-login-remember" class="control-group checkbox pull-left" <?php echo $divStyle; ?>>
			<label for="modlgn-remember" class="control-label"><?php echo $lblRememberMe; ?></label>
			<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
		</div>
		<?php endif; ?>
		
		<div id="form-login-submit" class="control-group pull-left" <?php echo $divStyle; ?>>
			<div class="controls">
				<div class="btn-group" role="group">
					<button type="submit" tabindex="0" name="Submit" class="btn btn-primary"><?php echo $lblLogin; ?></button>
					<a class="btn btn-default" href="<?php echo $urlRegister; ?>" role="button" <?php echo $disabledBtnRegister; ?>><?php echo $lblRegister; ?></a>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					   	<span class="caret"></span>
				    </button>
				    <ul class="dropdown-menu" role="menu">
				    	<li><a href="<?php echo $urlRemind; ?>"><?php echo $lblRemind; ?></a></li>
				    	<li><a href="<?php echo $urlReset; ?>"><?php echo $lblReset; ?></a></li>
				    </ul>
				</div>
			</div>
		</div>
		
		<input type="hidden" name="option" value="com_ecuser" />
		<input type="hidden" name="task" value="login.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div><div class="clearfix"></div>
</form>