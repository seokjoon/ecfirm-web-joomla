<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'contlikeObserver.php';



class EccontTableContlike extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_contlike', 'contlike', $_db);
		EccontTableContlikeObserver::createObserver
			($this, array('typeAlias' => 'com_eccontlike.contlike'));
	}
}