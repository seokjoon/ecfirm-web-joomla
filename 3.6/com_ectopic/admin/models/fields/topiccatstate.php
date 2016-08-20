<?php /** @package ecfirm.net
 * @copyright Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
JFormHelper::loadFieldClass('list');



class JFormFieldTopiccatstate extends JFormFieldList {

	/** * The form field type.
	 * @var		string
	 * @since   1.6 */
	protected $type = 'Topiccatstate';

	/** * Method to get the field options.
	 * @return  array  The field option objects.
	 * @since   1.6 */
	protected function getOptions() {
		$options = EctopicHelper::getTopiccatstateValues();
		//$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}