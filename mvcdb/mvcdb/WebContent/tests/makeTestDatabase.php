<?php
require_once(dirname(__FILE__)."/../models/Database.class.php");

function makeTestDatabase($dbName) {
	// Creates a database named $dbName for testing and returns connection
	$db = Database::getDB('');
	try {
		$db->query("DROP DATABASE if EXISTS $dbName;");
		$db->query("CREATE DATABASE $dbName;");
		$db->query("USE $dbName;");
		
		$db->query("DROP TABLE if EXISTS Users");
		$db->query("CREATE TABLE Users (
				userId             int(11) NOT NULL AUTO_INCREMENT,
				userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
				password           varchar(255) COLLATE utf8_unicode_ci,
				PRIMARY KEY (userId)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
		
		$db->query("INSERT INTO Users (userId, userName, password) VALUES
		           (1, 'Kay', 'xxx');");
		$db->query("INSERT INTO Users (userId, userName,  password) VALUES
	            	(2, 'John', 'yyy');");
		$db->query("INSERT INTO Users (userId, userName, password) VALUES
		(3, 'Alice', 'xxx');");
		$db->query("INSERT INTO Users (userId, userName,  password) VALUES
		(4, 'George', 'yyy');");

	} catch ( PDOException $e ) {
		echo $e->getMessage ();  // not final error handling
	}
	 
	return $db;
}
?>