<?php /** @package joomla.ecfirm.net
* @copyright	Copyright (C) joomla.ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
//jimport('joomla.filesystem.helper');



class EcFile {

	public static function delete($paths) { //EcDebug::log($paths);
		if(!(is_array($paths))) $paths = array($paths);
		foreach ($paths as &$path) { 
			$path = JPATH_SITE.'/'.$path; //EcDebug::log($path, 'loop');
			$bool = JFile::exists($path);
			if(!$bool) return false; 
		}
		return JFile::delete($paths);
	}
	
	public static function deleteDir($path) { 
		return JFolder::delete(JPATH_SITE.'/'.$path);
	}

	/**
	 * @example */
	public static function getFileModified($path) { //EcDebug::log('getFileModified: '.$path);
		$path = JPATH_SITE.'/upload/'.$path;
		$fileModified = filemtime($path); //$stat = stat($path);
		if($fileModified === false) return 0;
		else return $fileModified;
	}
	
	/**
	 * @example */
	public static function getFiles($path) { //EcDebug::log('getFiles: '.$path);
		$pathUpload = JPATH_SITE.'/upload';
		$pathFile = $pathUpload.'/'.$path;
		$exclude = array('index.html');
		$files = JFolder::files($pathFile, null, null, null, $exclude, null, true);
		$reg = new JRegistry;
		$reg->loadArray($files);
		$files = $reg->toObject();
		return $files;
	}
	
	/**
	 * @example */
	public static function getFilesModified($path) { //EcDebug::log('getFilesModified: '.$path);
		$path = JPATH_SITE.'/upload/'.$path;
		$exclude = array('index.html');
		$files = array();
		$modifieds = array();
		if(is_dir($path))
			$files = JFolder::files($path, null, null, null, $exclude, null, true);
		foreach ($files as $file) $modifieds[$file] = filemtime($path.$file);
		return $modifieds;	
	}

	public static function setFile($path) { //EcDebug::log($_FILES['file']); //name, tmp_name
		$src = $_FILES['file']['tmp_name'];
		$dest = $_FILES['file']['name'];
		$path = JPATH_SITE.'/upload/'.$path.'/'; //$path = JFactory::getConfig()->get('tmp_path').'/';
		return JFile::upload($src, $path.$dest);
	}

	public static function setFileByName($params, $nameKey) {
		$pathRelative = 'upload/'.$nameKey.'/';
		$path = JPATH_SITE.'/'.$pathRelative;
		$nameFile = time().'-'.rand().'.'.$params['name'];
		JFile::upload($params['tmp_name'], $path.$nameFile);
		$paths['file'] = $pathRelative.$nameFile;
		return $paths;
	}
	
	public static function setFileByUser($params, $nameKey) {
		$pathRelative = 'upload/user.'.JFactory::getUser()->id.'/'.$nameKey.'/';
		$path = JPATH_SITE.'/'.$pathRelative;
		$nameFile = time().'-'.rand().'.'.$params['name'];
		JFile::upload($params['tmp_name'], $path.$nameFile);
		$paths['file'] = $pathRelative.$nameFile;
		return $paths;
	}
}