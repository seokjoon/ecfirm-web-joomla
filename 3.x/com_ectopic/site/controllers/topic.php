<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EctopicControllerTopic extends EcControllerForm
{

	protected function allowAdd($data = array())
	{
		return EcPermit::allowAdd();
	}

	protected function allowEdit($data = array(), $nameKey = null)
	{
		if (empty($nameKey))
			$nameKey = $this->nameKey;
		$valueKey = (empty($data)) ? $this->input->get($nameKey, 0, 'uint') : $data[$nameKey];
		$model = $this->getModel($nameKey);
		$item = $model->getItem($valueKey);
		return EcPermit::allowEdit($item);
	}
	
	public function delete()
	{
		$bool = parent::delete();
		
		if($bool) {
			$uri = JUri::getInstance();
			$params = array(
				'view' => $this->nameKey . 's',
				'msg' => JText::_($this->option . '_' . $this->nameKey . '_DELETE_SUCCESS'),
				'etc' => 'topiccat=' . $uri->getVar('topiccat', 0),
			);
			$this->setRedirectParams($params);
		}
		
		return $bool;
	}

	public function save($nameKey = null, $urlVar = null)
	{
		$this->saveFile();
		$this->saveFileImg(); //EcDebug::log($this->input->post->get('jform', array(), 'array'), true);
		parent::save($nameKey, $urlVar);
	}
}