<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */

use Joomla\CMS\Factory;

defined('_JEXEC') or die('Restricted access');

class EcControllerBase extends Joomla\CMS\MVC\Controller\BaseController
{
	public function __construct(array $config = array())
	{
		parent::__construct($config);

		//TODO
	}

	public function t1()
	{
		echo intval(Factory::getUser()->guest);
	}
}