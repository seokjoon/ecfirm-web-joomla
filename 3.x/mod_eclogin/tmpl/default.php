<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');
JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

$usersConfig = JComponentHelper::getParams('com_users');
?>



<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-inline">
	<div class="userdata">
	
		<div id="form-login-username" class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">
						<span class="icon-user hasTooltip" title="<?php echo JText::_('MOD_ECLOGIN_LABEL_USERNAME') ?>"></span>
						<label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_ECLOGIN_LABEL_USERNAME'); ?></label>
					</span>
					<input id="modlgn-username" type="text" name="username" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_ECLOGIN_LABEL_USERNAME') ?>" />
				</div>
			</div>
		</div>
		
		<div id="form-login-password" class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">
						<span class="icon-lock hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>">
						</span>
							<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?>
						</label>
					</span>
					<input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
				</div>
			</div>
		</div>
		
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div id="form-login-remember" class="control-group checkbox">
			<label for="modlgn-remember" class="control-label"><?php echo JText::_('MOD_ECLOGIN_REMEMBER_ME') ?></label> <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
		</div>
		<?php endif; ?>
		
		<div id="form-login-submit" class="control-group">
			<div class="controls">
				<div class="btn-group" role="group">
					<button type="submit" tabindex="0" name="Submit" class="btn btn-primary"><?php echo JText::_('JLOGIN') ?></button>
					
					<div class="btn-group" role="group">
						<button type="button" tabindex="0" name="Submit" class="btn btn-default"><?php echo JText::_('MOD_ECLOGIN_REGISTER_LABEL') ?></button>
					
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					    	<span class="caret"></span>
					    </button>
					    <ul class="dropdown-menu" role="menu">
					    	<li><a href=""></a></li>
					    	<li><a href=""></a></li>
					    </ul>
					</div>
				
				</div>
			</div>
		</div>
		
		<input type="hidden" name="option" value="com_ecuser" />
		<input type="hidden" name="task" value="login.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>