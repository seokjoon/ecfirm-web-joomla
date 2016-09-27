<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgController extends JControllerLegacy	{
	/* protected $default_view = 'msgs';
	
	public function display($cachable = false, $urlparams = false) {
		$default_view = JComponentHelper::getParams('com_ecmsg')->get('default_view');
		if(!empty($default_view)) $this->default_view = $default_view;
		else $default_view = $this->default_view;
		$view = $this->input->get('view', 'msgs');
		$layout = $this->input->get('layout', 'msgs');
		$msg = $this->input->getInt('msg');
		if(($layout == 'edit') && (!$this->checkEditId('com_ecmsg.edit', $msg))) {
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $msg));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect
				(JRoute::_('index.php?option=com_ecmsg&view='.$default_view, false));
			return false; }
		parent::display();
		return this;
	} */
}