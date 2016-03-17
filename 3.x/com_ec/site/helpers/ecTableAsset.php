<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcTableAsset extends JTable {
	
	/** * Method to compute the default name of the asset.
	 * The default name is in the form table_name.id
	 * where id is the value of the primary key of the table.
	 * @return  string
	 * @since   11.1 */
	protected function _getAssetName() {
		/* $keys = array();
		 foreach ($this->_tbl_keys as $k) { $keys[] = (int) $this->$k; }
			return $this->_tbl.'.'.implode('.', $keys); */
		$k = $this->_tbl_key;
		if(!empty($this->type))
			return 'com_ec'.$this->type.'.'.$this->type.'.'.(int)$this->$k;
		else return 'com_ec'.$this->type.'.'.(int)$this->$k;
	}
	
	/** * Method to get the parent asset under which to register this one.
	 * By default, all assets are registered to the ROOT node with ID,
	 * which will default to 1 if none exists.
	 * The extended class can define a table and id to lookup.  If the
	 * asset does not exist it will be created.
	 * @param   JTable   $table  A JTable object for the asset parent.
	 * @param   integer  $id     Id to look up
	 * @return  integer
	 * @since   11.1 */
	protected function _getAssetParentId(JTable $table = null, $id = null) {
		/* // For simple cases, parent to the asset root.
		$assets = self::getInstance('Asset', 'JTable', array('dbo' => $this->getDbo()));
		$rootId = $assets->getRootId();
		if (!empty($rootId)) { return $rootId; } 
		return 1; */
		$assetParent = JTable::getInstance('Asset');
		$assetParentId = $assetParent->getRootId();
		if(!empty($this->type))
			$assetParent->loadByName('com_ec'.$this->type.'.'.$this->type);
		else $assetParent->loadByName('com_ec'.$this->type);
		if($assetParent->id) $assetParentId = $assetParent->id;	
		return $assetParentId;
	}
	
	/** * Method to return the title to use for the asset table.  In
	 * tracking the assets a title is kept for each asset so that there is some
	 * context available in a unified access manager.  Usually this would just
	 * return $this->title or $this->name or whatever is being used for the
	 * primary name of the row. If this method is not overridden, the asset name is used.
	 * @return  string  The string to use as the title in the asset table.
	 * @link    http://docs.joomla.org/JTable/getAssetTitle
	 * @since   11.1 */
	protected function _getAssetTitle() {
		return $this->_getAssetName(); //return 'touch';
	}
	
	/**
	 * Overloaded bind function
	 * @param   array  $array   Named array
	 * @param   mixed  $ignore  An optional array or space separated list of properties to ignore while binding.
	 * @return  mixed  Null if operation was satisfactory, otherwise returns an error string
	 * @see     JTable::bind()
	 * @since   11.1 */	
	public function bind($array, $ignore = '') {
		if (isset($array['params']) && is_array($array['params'])) {
		 	$registry = new JRegistry;
		 	$registry->loadArray($array['params']);
		 	$array['params'] = (string)$registry; 
		 }
		// Bind the rules.
		if (isset($array['rules']) && is_array($array['rules'])) {
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		}
		return parent::bind($array, $ignore);
	}
	
	
	
}