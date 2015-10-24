<?php
class DBMakerUnit {
	public static $unitTestPath = 'C:\xampp\myConfig.ini';
	
	public function createDB($dbName) {
		DBMaker::setConfigurationPath(self::$unitTestPath);
		DBMaker::create($dbName);
		Database::clearDB();
		$db = Database::getDB($dbName, self::$unitTestPath);
		return $db;
	}
}