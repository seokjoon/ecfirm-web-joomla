<?php /** bu@package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



$icUser = 'media/com_ec/images/ic_user-48.png';
$icTag = 'media/com_ec/images/ic_tag-128.png';
$nameKey = $this->nameKey;
$optionCom = JFactory::getApplication()->input->get('option');



require_once JPATH_COMPONENT.'/views/'.$nameKey.'/tmpl/default_item.php';