<?php /** @package ecfirm.net
 * @copyright Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcControllerItemAdmin extends JControllerForm {

	/**
	 * Constructor.
	 * @param   array  $config  An optional associative array of configuration settings.
	 * @see     JControllerLegacy
	 * @since   12.2
	 * @throws  Exception */
	public function __construct($config = array()) {
		parent::__construct($config);
		//EcDebug::log($this->view_item.':'.$this->view_list, __method__);
	}
}