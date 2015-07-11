<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
require_once 'prodcartObserver.php';



class EcprodTableProdcart extends JTable	{
	/** * @param   JDatabaseDriver  A database connector object */
	public function __construct(&$_db)	{
		parent::__construct('#__ec_prodcart', 'prodcart', $_db);
		EcprodTableProdcartObserver::createObserver
			($this, array('typeAlias' => 'com_ecprodcart.prodcart'));
	}
}