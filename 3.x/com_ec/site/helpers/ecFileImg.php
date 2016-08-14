<?php /** @package ecfirm.net
* @copyright	Copyright (C) ecfirm.net. All rights reserved.
* @license GNU General Public License version 2 or later. */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.image.image');



class EcFileImg extends EcFile {

	/**
	 * @throws
	 * @see http://php.net/manual/en/function.image-type-to-mime-type.php */
	public static function getType($type) {
		$ext = str_replace('image/', '', $type);
		return ($ext == 'jpeg') ? 'jpg' : $ext;
	}
	
	public static function setFileImgByName($params, $nameKey, $nameCol = 'img') { //EcDebug::log($params, __method__); 
		//$pathRelative = 'upload/shop.'.$jform['shop'].'/'.$nameKey.'/'; //EcDebug::log($path);
		$pathRelative = 'upload/'.$nameKey.'/'.$nameCol.'/'; //EcDebug::log($path);
		$path = JPATH_SITE.'/'.$pathRelative;
		////JFile::upload($params['tmp_name'], $path.$params['name']);
		//$nameFile = $jform[$nameKey].'.'.(self::getType($params['type']));
		$nameFile = time().'-'.rand().'.'.(self::getType($params['type']));
		JFile::upload($params['tmp_name'], $path.$nameFile);
		$jImg = new JImage($path.$nameFile);
		$params['rate'] = ((!(isset($params['rate']))) || (empty($params['rate'])))
			? '256x256' : $params['rate'];
		//3: 비율에 크기를 맞춤 //1: 크기에 비율을 맞춤 //5: 축소&crop하여 크기와 비율을 맞춤
		$thumbs = $jImg->createThumbs($params['rate'], 5); 
		$src = basename($thumbs[0]->getPath()); //EcDebug::log($src, __method__);
		$pathThumbs = $path.'/thumbs/'; //EcDebug::log($src.':'.$nameFile, __method__);
		if(JFile::move($src, $nameFile, $pathThumbs)) {
			$paths[$nameCol] = $pathRelative.$nameFile;
			$paths[$nameCol.'thumb'] = $pathRelative.'thumbs/'.$nameFile;
			return $paths; 
		} else return false;
	}
	
	//public static function setFileImgShop($jform, $params, $nameKey) { //EcDebug::log($params, __method__); 
	public static function setFileImgByUser($params, $nameKey, $nameCol = 'img') { //EcDebug::log($params, __method__); 
		//$pathRelative = 'upload/shop.'.$jform['shop'].'/'.$nameKey.'/'; //EcDebug::log($path);
		$pathRelative = 'upload/user.'.JFactory::getUser()->id.'/'.$nameKey.'/'.$nameCol.'/'; //EcDebug::log($path);
		$path = JPATH_SITE.'/'.$pathRelative;
		////JFile::upload($params['tmp_name'], $path.$params['name']);
		//$nameFile = $jform[$nameKey].'.'.(self::getType($params['type']));
		$nameFile = time().'-'.rand().'.'.(self::getType($params['type']));
		JFile::upload($params['tmp_name'], $path.$nameFile);
		$jImg = new JImage($path.$nameFile);
		$params['rate'] = ((!(isset($params['rate']))) || (empty($params['rate'])))
			? '256x256' : $params['rate'];
		//3: 비율에 크기를 맞춤 //1: 크기에 비율을 맞춤 //5: 축소&crop하여 크기와 비율을 맞춤
		$thumbs = $jImg->createThumbs($params['rate'], 5); 
		$src = basename($thumbs[0]->getPath()); //EcDebug::log($src, __method__);
		$pathThumbs = $path.'/thumbs/'; //EcDebug::log($src.':'.$nameFile, __method__);
		if(JFile::move($src, $nameFile, $pathThumbs)) {
			$paths[$nameCol] = $pathRelative.$nameFile;
			$paths[$nameCol.'thumb'] = $pathRelative.'thumbs/'.$nameFile;
			return $paths; 
		} else return false;
	}
	
	/**
	 * @deprecated
	 * @example DO NOT DELETE ME */
	public static function setFileImgLegacy($path = null, $thumbs = false) {
		if(!(parent::setFile($path))) return false;
		$fileName = $_FILES['file']['name'];
		if(!$thumbs) return true;
		//EcDebug::log(JPATH_SITE.'/upload/'.$path.'/'.$fileName);
		$jImg = new JImage(JPATH_SITE.'/upload/'.$path.'/'.$fileName);
		//EcDebug::log($jImg->getHeight());
		$thumbs = $jImg->createThumbs('470x470', 3);
		$src = basename($thumbs[0]->getPath());//EcDebug::log($src);
		////$img = $jImg->resize('40', '40', true);
		////$img->toFile(JPATH_SITE.'/upload/'.$path.'/thumbs/');
		//$src = JFile::stripExt($fileName).'_470x470.'.JFile::getExt($fileName);
		$path = JPATH_SITE.'/upload/'.$path.'/thumbs/';
		//EcDebug::log($fileName.':'.$src);
		return JFile::move($src, $fileName, $path);
	}
}