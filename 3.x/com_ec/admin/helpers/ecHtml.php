<?php /** @package ecfirm.net
* @copyright Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcHtml {
	/** * Build an array of block/unblock user states to be used by jgrid.state,
	 * State options will be different for any user
	 * and for currently logged in user
	 * @param   boolean  $self  True if state array is for currently logged in user
	 * @return  array  a list of possible states to display
	 * @since  3.0 */
	public static function bool($attr = 'enable') {
			$states = array(
				1 => array(
					'task'				=> 'off'.$attr,
					'text'				=> '',
					'active_title'		=> 'COM_EC_OFF_DESC',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'publish',
					'inactive_class'	=> 'publish'),
				0 => array(
					'task'				=> 'on'.$attr,
					'text'				=> '',
					'active_title'		=> 'COM_EC_ON_DESC',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'checkin',
					'inactive_class'	=> 'checkin'));
		return $states;
	}
}