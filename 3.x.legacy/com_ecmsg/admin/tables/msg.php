<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once '../../3.x/com_ecmsg/admin/tables/msgObserver.php';



class EcmsgTableMsg extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_msg', 'msg', $_db);
		EcmsgTableMsgObserver::createObserver
			($this, array('typeAlias' => 'com_ecmsg.msg'));
	}
}