<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'contcmtObserver.php';



class EccontTableContcmt extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_contcmt', 'contcmt', $_db);
		EccontTableContcmtObserver::createObserver
			($this, array('typeAlias' => 'com_eccontcmt.contcmt'));
	}
}