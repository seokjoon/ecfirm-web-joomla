<?php
/**
 * @package joomla.ecfirm.net
 * @copyright Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');

class EcControllerLegacy extends JControllerLegacy
{

	protected $entity; //ex) examples or example(plural or singular)

	protected $option; //ex) com_ecexample

	protected $nameKey; //ex) example

	public function __construct($config = array())
	{
		parent::__construct($config);
		
		$classNameArray = explode('Controller', get_called_class());
		$this->entity = strtolower($classNameArray[1]);
		$this->nameKey = (substr($this->entity, - 1) == 's') ? substr($this->entity, 0, - 1) : $this->entity;
		$this->option = 'com_' . strtolower($this->getName());
	}

	/**
	 * Method to add a new record.
	 * @return  mixed  True if the record can be added, a error object if not.
	 * @since   12.2 JControllerForm
	 */
	protected function add()
	{
		if (! ($this->allowAdd())) {
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			return false;
		}
		
		$this->setUserState('edit', 'data', null);
		
		return true;
	}

	/**
	 * Method to check if you can add a new record.
	 * Extended classes can override this if necessary.
	 * @param   array  $data  An array of input data.
	 * @return  boolean
	 * @since   12.2 JControllerForm
	 */
	protected function allowAdd($data = array())
	{ //XXX
		$user = JFactory::getUser();
		
		return ($user->authorise('core.create', $this->option) || count($user->getAuthorisedCategories($this->option, 'core.create')));
	}

	/**
	 * Method to check if you can edit an existing record.
	 * Extended classes can override this if necessary.
	 * @param   array   $data  An array of input data.
	 * @param   string  $nameKey   The name of the key for the primary key; default is id.
	 * @return  boolean
	 * @since   12.2 JControllerForm
	 */
	protected function allowEdit($data = array(), $nameKey = null)
	{
		//if(empty($nameKey)) $nameKey = $this->nameKey;
		return JFactory::getUser()->authorise('core.edit', $this->option);
	}

	/**
	 * Method to check if you can save a new or existing record.
	 * Extended classes can override this if necessary.
	 * @param   array   $data  An array of input data.
	 * @param   string  $nameKey   The name of the key for the primary key.
	 * @return  boolean
	 * @since   12.2 JControllerForm
	 */
	protected function allowSave($data, $nameKey = null)
	{
		if (empty($nameKey))
			$nameKey = $this->nameKey;

		$recordId = isset($data[$nameKey]) ? $data[$nameKey] : '0';
		
		if ($recordId)
			return $this->allowEdit($data, $nameKey);
		else
			return $this->allowAdd($data);
	}

	/**
	 * Method to cancel an edit.
	 * @param   string  $nameKey  The name of the primary key of the URL variable.
	 * @return  boolean  True if access level checks pass, false otherwise.
	 * @since   12.2 JControllerForm
	 */
	protected function cancel($nameKey = null)
	{
		//if(empty($nameKey)) $nameKey = $this->nameKey;
		$this->setUserState('edit', 'data', null);

		return true;
	}

	/** * Removes an item.
	 * @return  boolean
	 * @since   12.2 JControllerAdmin
	 */
	protected function delete()
	{
		$valueKeys = $this->input->get($this->nameKey, array(), 'array');
		if (empty($valueKeys)) {
			$jform = $this->input->post->get('jform', array(), 'array');
			$valueKeys = array(
				$jform[$this->nameKey]
			);
		}
		
		if (! (is_array($valueKeys)) || count($valueKeys) < 1)
			return false;
		
		$model = $this->getModel(); //EcDebug::lp($model, true);
		
		jimport('joomla.utilities.arrayhelper');
		JArrayHelper::toInteger($valueKeys);
		
		if ($model->delete($valueKeys))
			$this->setMessage(JText::plural($this->option . '_' . $this->entity . '_N_ITEMS_DELETED', count($valueKeys)));
		else {
			$this->setMessage($model->getError(), 'error');
			return false;
		}
		
		$this->postDeleteHook($model, $valueKeys);
		
		return true;
	}

	/**
	 * Method to edit an existing record.
	 * @param   string  $nameKey     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key
	 * (sometimes required to avoid router collisions).
	 * @return  boolean  True if access level check and checkout passes, false otherwise.
	 * @since   12.2 JControllerForm
	 */
	protected function edit($nameKey = null, $urlVar = null)
	{
		if (empty($nameKey))
			$nameKey = $this->nameKey;

		$valueKey = $this->input->post->get($nameKey, 0, 'uint');

		if (! ($this->allowEdit(array(
			$nameKey => $valueKey
		), $nameKey))) {
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			return false;
		}

		$this->setUserState('edit', 'data', null);

		return true;
	}

	protected function getItem($valueKey = 0, $nameKey = null)
	{
		if (empty($nameKey))
			$nameKey = $this->nameKey;
		if ($valueKey == 0)
			$valueKey = $this->input->get($nameKey, '0', 'uint');
		
		$model = $this->getModel($nameKey);

		return $model->getItem($valueKey);
	}

	protected function getItems($name = null)
	{
		if (empty($name))
			$name = $this->entity;

		$model = $this->getModel($name);

		return $model->getItems();
	}

	/**
	 * Method to get a model object, loading it if required.
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 * @return  object  The model.
	 * @since   12.2 JControllerLegacy
	 */
	public function getModel($name = null, $prefix = null, $config = array())
	{
		if (empty($name))
			$name = $this->entity;

		return parent::getModel($name, $prefix, $config);
	}

	protected function getRedirectLogin()
	{
		$return = $this->getRedirectRequest();
		
		$prefix = EcConst::getPrefix();

		return 'index.php?option=com_' . $prefix . 'user&view=login&return=' . $return;
	}

	protected function getRedirectRequest()
	{
		//$request = $_SERVER['REQUEST_URI'];
		$request = JUri::getInstance()->toString();
		
		if (empty($request) || ! JUri::isInternal($request))
			return $this->getRedirectReturn();
		else
			return $request;
	}

	protected function getRedirectReturn()
	{
		$return = $this->input->get('return', null, 'base64');

		//if(empty($return) || !JUri::isInternal(base64_decode($return)))
		if (empty($return))
			return JUri::base();
		else
			return base64_decode($return);
	}

	protected function getUser()
	{
		return JFactory::getUser()->id;
	}

	protected function getUserState($task, $key, $default)
	{
		$context = $this->option . '.' . $task . '.' . $this->nameKey . '.' . $key;
		
		$app = JFactory::getApplication();

		return $app->getUserState($context, $default);
	}

	/**
	 * Function that allows child controller access to model data
	 * after the item has been deleted.
	 * @param   JModelLegacy  $model  The data model object.
	 * @param   integer       $id     The validated data.
	 * @return  void
	 * @since   12.2 JControllerAdmin
	 */
	protected function postDeleteHook(JModelLegacy $model, $id = null)
	{}

	/**
	 * Function that allows child controller access to model data
	 * after the data has been saved.
	 * @param   JModelLegacy  $model      The data model object.
	 * @param   array         $validData  The validated data.
	 * @return  void
	 * @since   12.2 JControllerForm
	 */
	protected function postSaveHook(JModelLegacy $model, $validData = array())
	{}

	/**
	 * Method to save a record.
	 * @param   string  $nameKey     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 * @return  boolean  True if successful, false otherwise.
	 * @since   12.2 JControllerForm
	 */
	protected function save($nameKey = null, $urlVar = null)
	{
		if (empty($nameKey))
			$nameKey = $this->nameKey;
		
		$app = JFactory::getApplication();
		$lang = JFactory::getLanguage();
		$model = $this->getModel();
		
		$data = $this->input->post->get('jform', array(), 'array'); //EcDebug::log($data);
		//$data[$nameKey] = ((!(isset($data[$nameKey]))) || (empty($data[$nameKey]))) ?
		//$this->input->get($nameKey, 0, 'uint') : 0;
		
		if (! ($this->allowSave($data, $nameKey))) {
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_SAVE_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			return false;
		}
		
		////////
		if (($nameKey != 'user') && (isset($data['user'])))
			$data['user'] = JFactory::getUser()->id; //FIXME
		////////
		
		////////
		$layout = $app->input->get('layout', null, 'string');
		
		$nameModelForm = (empty($layout)) ? $this->entity . 'form' : $layout . 'form';
		$modelForm = $this->getModel($nameModelForm);
		
		$form = $modelForm->getForm($data, false);
		
		if (! ($form)) {
			$app->enqueueMessage($modelForm->getError(), 'error');
			return false;
		}
		
		$validData = $modelForm->validate($form, $data); //EcDebug::log($validData);
		
		if ($validData === false) {
			$errors = $modelForm->getErrors();
			//Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i ++)
				if ($errors[$i] instanceof Exception)
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				else
					$app->enqueueMessage($errors[$i], 'warning');
			$this->setUserState('edit', 'data', $data);
			return false;
		}
		////////

		if (! ($model->save($validData))) {
			$this->setUserState('edit', 'data', $validData);
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
			$this->setMessage($this->getError(), 'error');
			return false;
		}
		
		$postfix = ($data[$nameKey] == 0) ? '_SUBMIT' : '_SAVE_SUCCESS';
		$msg = strtoupper($this->option) . $postfix;
		
		if (! ($lang->hasKey($msg)))
			$msg = 'JLIB_APPLICATION' . $postfix;
		
		$this->setMessage(JText::_($msg));
		$this->setUserState('edit', 'data', null);

		return true;
	}

	protected function setViewModel($nameModel = null, $nameView = null)
	{
		/*
		 * $viewType = JFactory::getDocument()->getType();
		 * $viewName = $this->input->get('view', $this->default_view);
		 * $viewLayout = $this->input->get('layout', 'default', 'string');
		 * $view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
		 */
		$model = $this->getModel($nameModel);
		
		if (empty($nameView))
			$nameView = $this->input->get('view');
		
		$view = $this->getView($nameView, JFactory::getDocument()->getType());

		return $view->setModel($model);
	}

	protected function setRedirectParams($params = array())
	{
		$prefix = 'index.php';
		$option = (isset($params['option'])) ? '?option=com_' . $params['option'] : $option = '?option=com_' . $this->name;
		$view = (isset($params['view'])) ? '&view=' . $params['view'] : '&view=' . ($this->input->get('view', null, 'string'));
		$task = (isset($params['task'])) ? '&task=' . $params['task'] : '';
		$key = ((isset($params['nameKey'])) && (isset($params['valueKey']))) ? '&' . $params['nameKey'] . '=' . $params['valueKey'] : '';
		$format = (isset($params['format'])) ? '&format=' . $params['format'] : '';
		'&format=' . ($this->input->get('format', 'html', 'string'));
		$layout = (isset($params['layout'])) ? $params['layout'] : $this->input->get('layout', null, 'string');
		$layout = (empty($layout)) ? '' : '&layout=' . $layout;
		$itemId = (isset($params['itemId'])) ? $params['itemId'] : EcUrl::getItemId();
		$itemId = ($itemId > 0) ? '&Itemid=' . $itemId : '';
		$etc = (isset($params['etc'])) ? '&' . $params['etc'] : '';
		$url = (isset($url)) ? $params['url'] : $prefix . $option . $view . $task . $key . $format . $layout . $itemId . $etc;
		$msg = (isset($params['msg'])) ? $params['msg'] : null;
		$type = (isset($params['type'])) ? $params['type'] : null;
		//EcDebug::lp($url, 'url'); EcDebug::lp($msg, 'msg'); EcDebug::lp($type, 'type');

		$this->setRedirect($url, $msg, $type); //$this->setRedirect(JRoute::_($url));
		//$this->redirect();
	}

	protected function setUserState($task, $key, $value)
	{
		$context = $this->option . '.' . $task . '.' . $this->nameKey . '.' . $key;
		
		$app = JFactory::getApplication();

		$app->setUserState($context, $value);
	}
}