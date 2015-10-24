<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';

class DatabaseTest extends PHPUnit_Framework_TestCase {

	public function testOpenConnectionToValidDatabase() {   
	  $db = DBMakerUnit::createDB('ptest');
	  $this->assertTrue($db != null, 
	  		'It should create a non-null connection to a database that does not exist');
	}
	
	public function testOpenConnectionToInvalidDatabase() {
		ob_start();
		DBMaker::delete('ptest1');
		Database::clearDB();

		$db = Database::getDB($dbName = 'ptest1', DBMakerUnit::$unitTestPath);
		$output = ob_get_clean();
		$this->assertNull($db,
				'It should not create a connection to a database that does not exist');
		$this->assertFalse(empty($output),
				"It should produce error messages when database does not exist");		
	}
}
?>