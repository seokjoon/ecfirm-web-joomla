<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$valueKey = (is_object($item)) ? $item->$nameKey : 0; //EcDebug::lp($item);
echo '<br />'.__file__;