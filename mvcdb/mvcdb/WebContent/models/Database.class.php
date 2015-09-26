<?php
// Responsibility: maintains open DB connection (singleton)
class Database {
private static $db;
	private static $dsn = 'mysql:host=localhost;dbname=';
	private static $dbName;
	private static $username = 'root';
	private static $password = '';
	private static $options = 
	   array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
	public static function getDB($dbName = 'classbash') {
		if (!isset (self::$db)) {
			try {
				self::$dbName = $dbName;
				$dbspec = self::$dsn . self::$dbName;
				self::$db = new PDO ($dbspec, self::$username,
					  	             self::$password, self::$options);
			} catch (PDOException $e ) {
			echo $e->getMessage ();  // not final error handling
			}
		}
		return self::$db;
	}
}
?>