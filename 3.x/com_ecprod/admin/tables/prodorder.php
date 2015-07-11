<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'prodorderObserver.php';



class EcprodTableProdorder extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_prodorder', 'prodorder', $_db);
		EcprodTableProdorderObserver::createObserver
			($this, array('typeAlias' => 'com_ecprodorder.prodorder'));
	}
}