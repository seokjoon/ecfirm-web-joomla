<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'contObserver.php';



class EccontTableCont extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_cont', 'cont', $_db);
		EccontTableContObserver::createObserver
			($this, array('typeAlias' => 'com_eccont.cont'));
	}
}