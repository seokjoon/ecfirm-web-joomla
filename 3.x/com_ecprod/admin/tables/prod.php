<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'prodObserver.php';



class EcprodTableProd extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_prod', 'prod', $_db);
		EcprodTableProdObserver::createObserver
			($this, array('typeAlias' => 'com_ecprod.prod'));
	}
}