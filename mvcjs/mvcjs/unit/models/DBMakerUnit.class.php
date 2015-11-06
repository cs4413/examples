<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Configuration.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';

class DBMakerUnit {
	public static $unitConfigurationPath = 'C:\xampp\myConfig.ini';
	public static $unitUploadPath = 'C:\xampp\uploads';
	
	public function createDB($dbName) {
		
		Configuration::setConfigurationPath(self::$unitConfigurationPath);
		Configuration::setUploadPath(self::$unitUploadPath);
		DBMaker::create($dbName);
		Database::clearDB();
		$db = Database::getDB($dbName, self::$unitConfigurationPath);
		return $db;
	}
}