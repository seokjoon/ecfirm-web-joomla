<?php /** @package ecfirm.net
 * @copyright	Copyright (C) ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EctopicModelTopic extends EcModelItem	{

	/** Method to get article data.
	 * @param   integer  $itemId  The id of the article.
	 * @return  mixed  Content item data object on success, false on failure.
	 * @since 12.2 JModelAdmin */
	public function getItem($valueKey = null)	{
		$item = parent::getItem($valueKey);
		if(empty($item)) return $item;
		if($item->user > 0) {
			$table = $this->getTable('User', 'JTable');
			$table->load($item->user);
			$item->ju_name = $table->name;
		}
		return $item;
	}
}