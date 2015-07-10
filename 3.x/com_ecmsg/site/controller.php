<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcmsgController extends EcControllerLegacy {
	
	/**
	 * Method to display a view.
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   boolean  $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 * @return  JController  This object to support chaining. */
	public function display($cachable = false, $urlparams = false) {
		/* $viewName = $this->input->getCmd('view', 'msgs');
		//$this->input->set('view', $viewName);
		$this->default_view = $viewName;
		$msg = $this->input->get('msg', 0, 'uint');
		//XXX: cacheable
		//XXX: safeurlparams
		if(($viewName == 'form') && (!($this->checkEditId('com_ecmsg.edit.msg', $msg))))
			return JError::raiseError
				(403, JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
		$this->default_view = 'msgs'; */
		if((($this->input->getCmd('view', 'msgs', 'string')) == 'msgs') 
			&& (empty($this->input->get('task', null, 'string'))))
			$this->setRedirectParams(array('view' => 'msgs', 'task' => 'msgs.display'));
		else {
			parent::display($cachable, $urlparams);
			return $this; }
	}
}