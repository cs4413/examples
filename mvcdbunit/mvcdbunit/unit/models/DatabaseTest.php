<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'DBMaker.php';

class DatabaseTest extends PHPUnit_Framework_TestCase {
	
	public function testOpenConnectionToValidDatabase() {
	  DBMaker::create( 'ptest1' );
	  $db = Database::getDB($dbName = 'ptest1', 
	  		$configPath ="C:".DIRECTORY_SEPARATOR."xampp".DIRECTORY_SEPARATOR."myConfig.ini");
	  $this->assertTrue($db != null, 
	  		'It should create a non-null connection to a database that does not exist');
	}
	
	public function testOpenConnectionToInalidDatabase() {
		DBMaker::delete( 'ptest1' );
		Database::clearDB();
		$db = Database::getDB($dbName = 'ptest1',
				$configPath ="C:".DIRECTORY_SEPARATOR."xampp".DIRECTORY_SEPARATOR."myConfig.ini");
		$this->assertNull($db,
				'It should not create a connection to a database that does not exist');
	}
}
?>