<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'userObserver.php';



class EcuserTableUser extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_user', 'user', $_db);
		EcuserTableUserObserver::createObserver
			($this, array('typeAlias' => 'com_ecuser.user'));
	}
}