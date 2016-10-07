<?php 
/** 
 * @package joomla.ecfirm.net
 * @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
 * @license GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted access');



class EcuserModelRegistrationform extends EcModelForm {

	/**
	 * Method to activate a user account.
	 * @param   string  $token  The activation token.
	 * @return  mixed    False on failure, user object on success.
	 * @since   1.6
	 */
	public function activate($token) {
		$db = $this->getDbo();
		// Get the user id based on the token.
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id'))
			->from($db->quoteName('#__users'))
			->where($db->quoteName('activation') . ' = ' . $db->quote($token))
			->where($db->quoteName('block') . ' = ' . 1)
			->where($db->quoteName('lastvisitDate') . ' = ' . $db->quote($db->getNullDate()));
		$db->setQuery($query);
		try { $userId = (int) $db->loadResult(); }
		catch (RuntimeException $e) {
			$this->setError(JText::sprintf('COM_ECUSER_DATABASE_ERROR', $e->getMessage()), 500);
			return false;
		}
		if (!$userId) {
			$this->setError(JText::_('COM_ECUSER_ACTIVATION_TOKEN_NOT_FOUND'));
			return false;
		}
		
		$config = JFactory::getConfig();
		$userParams = JComponentHelper::getParams('com_users');
		// Load the users plugin group.
		JPluginHelper::importPlugin('user');
		// Activate the user.
		$user = JFactory::getUser($userId);
		$data = $user->getProperties();

		// Admin activation is on and user is verifying their email
		if (($userParams->get('useractivation') == 2) && !$user->getParam('activate', 0)) {
			$data['activation'] = 
				JApplicationHelper::getHash(JUserHelper::genRandomPassword());
			$user->set('activation', $data['activation']);
			$user->setParam('activate', 1);
			if(!($this->activateSendMailAdmin($user, $data))) return false;
		} 
		// Admin activation is on and admin is activating the account
		elseif (($userParams->get('useractivation') == 2) && $user->getParam('activate', 0)) {
			$user->set('activation', '');
			$user->set('block', '0');
			$user->setParam('activate', 0);
			if(!($this->activateSendMail($user, $data))) return false;
		}
		else {
			$user->set('activation', '');
			$user->set('block', '0');
		}
		
		// Store the user object.
		if (!$user->save()) {
			$this->setError(JText::sprintf
				('COM_ECUSER_REGISTRATION_ACTIVATION_SAVE_FAILED', $user->getError()));
			return false;
		}
		return $user;
	}
	
	private function activateSendMail($user, $data) {
		$config = JFactory::getConfig();
		
		// Compile the user activated notification mail values.
		$data['fromname'] = $config->get('fromname');
		$data['mailfrom'] = $config->get('mailfrom');
		$data['sitename'] = $config->get('sitename');
		$data['siteurl'] = JUri::base();
		$emailSubject = JText::sprintf(
			'COM_ECUSER_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_SUBJECT',
			$data['name'],
			$data['sitename']
		);
		$emailBody = JText::sprintf(
			'COM_ECUSER_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_BODY',
			$data['name'],
			$data['siteurl'],
			$data['username']
		);

		$return = JFactory::getMailer()->sendMail
			($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);
		// Check for an error.
		if ($return !== true) {
			$this->setError(JText::_
				('COM_ECUSER_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
			return false;
		}
		return $return;
	}
	
	private function activateSendMailAdmin($user, $data) {
		$config = JFactory::getConfig();
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		
		// Compile the admin notification mail values.
		$data['siteurl'] = JUri::base();
		$base = JUri::getInstance()->toString
			(array('scheme', 'user', 'pass', 'host', 'port'));
		$data['activate'] = $base . JRoute::_
			('index.php?option=com_ecuser&task=registration.activate&token=' 
			. $data['activation'], false);
		// Remove administrator/ from activate url in case this method is called from admin
		if (JFactory::getApplication()->isAdmin()) {
			$adminPos = strrpos($data['activate'], 'administrator/');
			$data['activate'] = substr_replace($data['activate'], '', $adminPos, 14);
		}
		$data['fromname'] = $config->get('fromname');
		$data['mailfrom'] = $config->get('mailfrom');
		$data['sitename'] = $config->get('sitename');
		$emailSubject = JText::sprintf(
			'COM_ECUSER_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_SUBJECT',
			$data['name'],
			$data['sitename']
		);
		$emailBody = JText::sprintf(
			'COM_ECUSER_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_BODY',
			$data['sitename'],
			$data['name'],
			$data['email'],
			$data['username'],
			$data['activate']
		);

		// Get all admin users
		$query->clear()
			->select($db->quoteName(array('name', 'email', 'sendEmail', 'id')))
			->from($db->quoteName('#__users'))
			->where($db->quoteName('sendEmail') . ' = ' . 1);
		$db->setQuery($query);
		try { $rows = $db->loadObjectList(); }
		catch (RuntimeException $e) {
			$this->setError(JText::sprintf
				('COM_ECUSER_DATABASE_ERROR', $e->getMessage()), 500);
			return false;
		}

		// Send mail to all users with users creating permissions and receiving system emails
		foreach ($rows as $row) {
			$usercreator = JFactory::getUser($row->id);
			if ($usercreator->authorise('core.create', 'com_users')) {
				$return = JFactory::getMailer()->sendMail
					($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBody);
				// Check for an error.
				if ($return !== true) {
					$this->setError(JText::_
						('COM_ECUSER_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
					return false;
				}
			}
		}
		return $return;
	}
	
	/**
	 * Method to get the registration form data.
	 * @return  mixed  Data object on success, false on failure.
	 * @since   1.6
	 */
	public function getData() { //TODO: test me
		if ((!isset($this->data)) || ($this->data === null)) {
			$this->data = new stdClass;
			$app = JFactory::getApplication();
			$params = JComponentHelper::getParams('com_users');
			// Override the base user data with any data in the session.
			$temp = (array) $app->getUserState('com_ecuser.registration.data', array());
			foreach ($temp as $k => $v) $this->data->$k = $v;
			// Get the groups the user should be added to after registration.
			$this->data->groups = array();
			// Get the default new user group, Registered if not specified.
			$system = $params->get('new_usertype', 2);
			$this->data->groups[] = $system;
			// Unset the passwords.
			unset($this->data->password1);
			unset($this->data->password2);
		}
		return $this->data;
	}
	
	public function getTable($type = 'User', $prefix = 'EcuserTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Method to save the form data.
	 * @param   array  $temp  The form data.
	 * @return  mixed  The user id on success, false on failure.
	 * @since   1.6
	 */
	public function register($temp) {
		$params = JComponentHelper::getParams('com_users');
		// Initialise the table with JUser.
		$user = new JUser;
		$data = (array) $this->getData();
		// Merge in the registration data.
		foreach ($temp as $k => $v) $data[$k] = $v;
		// Prepare the data for the user object.
		$data['email'] = JStringPunycode::emailToPunycode($data['email']);
		$data['password'] = $data['password'];
		$useractivation = $params->get('useractivation');
		//$sendpassword = $params->get('sendpassword', 1); //move to $this->registerActivate()
		// Check if the user needs to activate their account.
		if (($useractivation == 1) || ($useractivation == 2)) {
			$data['activation'] = 
				JApplicationHelper::getHash(JUserHelper::genRandomPassword());
			$data['block'] = 1;
		}
		
		// Bind the data.
		if (!$user->bind($data)) {
			$this->setError(JText::sprintf
				('COM_ECUSER_REGISTRATION_BIND_FAILED', $user->getError()));
			return false;
		}
		// Load the users plugin group.
		JPluginHelper::importPlugin('user');
		// Store the data.
		if (!$user->save()) {
			$this->setError(JText::sprintf
				('COM_ECUSER_REGISTRATION_SAVE_FAILED', $user->getError()));
			return false;
		}
		
		// Compile the notification mail values.
		$data = $user->getProperties();
		$config = JFactory::getConfig();
		$data['fromname'] = $config->get('fromname');
		$data['mailfrom'] = $config->get('mailfrom');
		$data['sitename'] = $config->get('sitename');
		$data['siteurl'] = JUri::root();
		
		$bool = $this->registerSendMail($data, $params);
		if($bool) $bool = $this->registerSendMailAdmin($data, $params);
		$activateArray = EcuserConst::ACTIVATE_TYPE; //array 
		return ($bool) 
			? array('user' => $user, 'activate' => $activateArray[$useractivation])
			: false;
	}
	
	private function registerSendMail($data, $params) { 
		$useractivation = $params->get('useractivation');
		$sendpassword = $params->get('sendpassword', 1);
		
		// Handle account activation/confirmation emails.
		if($useractivation == 2) { //admin activation
			// Set the link to confirm the user email.
			$base = JUri::getInstance()->toString
				(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base . JRoute::_
				('index.php?option=com_ecuser&task=registration.activate&token='
				. $data['activation'], false);
			// Remove administrator/ from activate url in case this method is called from admin
			if (JFactory::getApplication()->isAdmin()) {
				$adminPos = strrpos($data['activate'], 'administrator/');
				$data['activate'] = substr_replace($data['activate'], '', $adminPos, 14);
			}
			$emailSubject = JText::sprintf
				('COM_ECUSER_EMAIL_ACCOUNT_DETAILS', $data['name'], $data['sitename']);
			if($sendpassword) {
				$emailBody = JText::sprintf(
					'COM_ECUSER_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username'],
					$data['password_clear']
				);
			} else {
				$emailBody = JText::sprintf(
					'COM_ECUSER_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY_NOPW',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username']
				);
			}
		} elseif ($useractivation == 1) { //user activation
			// Set the link to activate the user account.
			$base = JUri::getInstance()->toString
				(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base . JRoute::_
				('index.php?option=com_ecuser&task=registration.activate&token=' 
				. $data['activation'], false);
			// Remove administrator/ from activate url in case this method is called from admin
			if (JFactory::getApplication()->isAdmin()) {
				$adminPos         = strrpos($data['activate'], 'administrator/');
				$data['activate'] = substr_replace($data['activate'], '', $adminPos, 14);
			}
			$emailSubject = JText::sprintf(
				'COM_ECUSER_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);
			if ($sendpassword) {
				$emailBody = JText::sprintf(
					'COM_ECUSER_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username'],
					$data['password_clear']
				);
			} else {
				$emailBody = JText::sprintf(
					'COM_ECUSER_EMAIL_REGISTERED_WITH_ACTIVATION_BODY_NOPW',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username']
				);
			}
		} else {
			$emailSubject = JText::sprintf(
				'COM_ECUSER_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);
			if ($sendpassword) {
				$emailBody = JText::sprintf(
					'COM_ECUSER_EMAIL_REGISTERED_BODY',
					$data['name'],
					$data['sitename'],
					$data['siteurl'],
					$data['username'],
					$data['password_clear']
				);
			} else {
				$emailBody = JText::sprintf(
					'COM_ECUSER_EMAIL_REGISTERED_BODY_NOPW',
					$data['name'],
					$data['sitename'],
					$data['siteurl']
				);
			}
		}
		
		// Send the registration email.
		return JFactory::getMailer()->sendMail
			($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);
	}
	
	private function registerSendMailAdmin($data, $params) {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		
		// Send Notification mail to administrators
		if (($params->get('useractivation') < 2) && ($params->get('mail_to_admin') == 1)) {
			$emailSubject = JText::sprintf(
				'COM_ECUSER_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);
			$emailBodyAdmin = JText::sprintf(
				'COM_ECUSER_EMAIL_REGISTERED_NOTIFICATION_TO_ADMIN_BODY',
				$data['name'],
				$data['username'],
				$data['siteurl']
			);

			// Get all admin users
			$query->clear()
				->select($db->quoteName(array('name', 'email', 'sendEmail')))
				->from($db->quoteName('#__users'))
				->where($db->quoteName('sendEmail') . ' = ' . 1);
			$db->setQuery($query);
			try { $rows = $db->loadObjectList(); }
			catch (RuntimeException $e) {
				$this->setError
					(JText::sprintf('COM_ECUSER_DATABASE_ERROR', $e->getMessage()), 500);
				return false;
			}
			// Send mail to all superadministrators id
			foreach ($rows as $row) {
				$return = JFactory::getMailer()->sendMail($data['mailfrom'], 
					$data['fromname'], $row->email, $emailSubject, $emailBodyAdmin);
				// Check for an error.
				if ($return !== true) {
					$this->setError(JText::_
						('COM_ECUSER_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
					return false;
				}
			}
		}
		
		// Check for an error.
		if ((isset($return)) && ($return !== true)) {
			$this->setError(JText::_('COM_ECUSER_REGISTRATION_SEND_MAIL_FAILED'));
			// Send a system message to administrators receiving system mails
			$db = $this->getDbo();
			$query->clear()
				->select($db->quoteName(array('name', 'email', 'sendEmail', 'id')))
				->from($db->quoteName('#__users'))
				->where($db->quoteName('block') . ' = ' . (int) 0)
				->where($db->quoteName('sendEmail') . ' = ' . (int) 1);
			$db->setQuery($query);
			try { $sendEmail = $db->loadColumn(); }
			catch (RuntimeException $e) {
				$this->setError(JText::sprintf
					('COM_ECUSER_DATABASE_ERROR', $e->getMessage()), 500);
				return false;
			}
			if (count($sendEmail) > 0) {
				$jdate = new JDate;
				// Build the query to add the messages
				foreach ($sendEmail as $userid) {
					$values = array(
						$db->quote($userid),
						$db->quote($userid),
						$db->quote($jdate->toSql()),
						$db->quote(JText::_('COM_ECUSER_MAIL_SEND_FAILURE_SUBJECT')),
						$db->quote(JText::sprintf
							('COM_ECUSER_MAIL_SEND_FAILURE_BODY', $return, $data['username']))
					);
					$query->clear()
						->insert($db->quoteName('#__messages'))
						->columns($db->quoteName(array
							('user_id_from', 'user_id_to', 'date_time', 'subject', 'message')))
						->values(implode(',', $values));
					$db->setQuery($query);
					try { $db->execute(); }
					catch (RuntimeException $e) {
						$this->setError(JText::sprintf
							('COM_ECUSER_DATABASE_ERROR', $e->getMessage()), 500);
						return false;
					}
				}
			}
			return false;
		}
		return true;
	}
}