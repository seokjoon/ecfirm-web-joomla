<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once '../../3.x/com_ecuser/admin/tables/userlikeObserver.php';



class EcuserTableUserlike extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_userlike', 'userlike', $_db);
		EcuserTableUserlikeObserver::createObserver
			($this, array('typeAlias' => 'com_ecuserlike.userlike'));
	}
}