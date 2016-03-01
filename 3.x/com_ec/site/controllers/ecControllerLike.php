<?php /** @package ecfirm.net
* @copyright	Copyright (C) kilmeny.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');



class EcControllerLike extends EcControllerAjax {

	public function add() { //if(!($this->allowAdd())) jexit('false');
		$allowAdd = $this->allowAdd();
		$nameKey = $this->nameKey;
		$nameCol = str_replace('like', '', $nameKey);
		$data = $this->input->post->get('jform', array(), 'array');
		$valueCol = $data[$nameCol];
		if($allowAdd) {
			$data[$nameKey] = 0;
			$data['user'] = JFactory::getUser()->id;
			$params['where'] = array($nameCol => $valueCol, 'user' => $data['user']);
			if(EcDml::selectByParams($params, $nameKey) == 0) {
				if(!($this->allowSave($data, $nameKey))) jexit('false');
				if(!($this->getModel()->save($data))) jexit('false'); 
			}
		}
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($nameCol));
		if($allowAdd) $view->save($valueCol); else $view->addFail($valueCol);
	}
	
	public function addFail() {
		$return = $this->getRedirectLogin(); 
		echo '<script>window.location.href="'.$return.'"</script>';
		jexit();
	}
	
	public function cancel($nameKey = null) { jexit(); }
	
	public function delete() { //EcDebug::log($this->input->post->get('jform', array(), 'array'));
		//$nameKey = $this->nameKey;
		//$valueKey = $this->input->get($nameKey, 0, 'uint');
		//$asset = $this->option.'.'.$nameKey.'.'.$valueKey;
		//if(!(JFactory::getUser()->authorise('core.delete', $asset))) jexit('false');
		//TODO asset
		$data = $this->input->post->get('jform', array(), 'array');//EcDebug::log($data);
		$nameKey = $this->nameKey;
		$nameCol = str_replace('like', '', $nameKey);
		$valueCol = $data[$nameCol];
		$params['where'] = array($nameCol => $valueCol, 'user' => JFactory::getUser()->id);
		$valueKey = EcDml::selectByParams($params, $nameKey);
		$this->input->set($nameKey, $valueKey);
		if($valueKey != 0) if(!(EcControllerLegacy::delete())) jexit('false');
		$view = $this->getView($this->default_view, JFactory::getDocument()->getType());
		$view->setModel($this->getModel($nameCol));
		$view->delete($valueCol);
	}
}