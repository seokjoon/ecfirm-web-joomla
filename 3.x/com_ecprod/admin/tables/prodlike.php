<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'prodlikeObserver.php';



class EcprodTableProdlike extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_prodlike', 'prodlike', $_db);
		EcprodTableProdlikeObserver::createObserver
			($this, array('typeAlias' => 'com_ecprodlike.prodlike'));
	}
}