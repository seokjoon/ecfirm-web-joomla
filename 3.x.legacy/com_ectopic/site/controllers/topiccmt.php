<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicControllerTopiccmt extends EcControllerCmt {
	
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->cmtType = 'topic'; 
	}
}