<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
JFormHelper::loadFieldClass('list');



class JFormFieldCont extends JFormFieldList	{
	/** * The form field type.
	 * @var		string
	 * @since   1.6 */
	protected $type = 'Cont';
	
	/** * Method to get the field options.
	 * @return  array  The field option objects.
	 * @since   1.6 */
	protected function getOptions()	{
		$options = array();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('c.cont as value, c.title as text') 
			->from('#__ec_cont as c')
			->order('c.title');
		$db->setQuery($query);
		try { $options = $db->loadObjectList(); } 
		catch (RuntimeException $e) { JError::raiseWarning(500, $e->getMessage()); }
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}