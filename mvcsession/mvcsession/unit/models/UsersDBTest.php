<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';


class UsersDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllUsers() {
  	  DBMaker::setConfigurationPath(DBMaker::$unitTestPath);
  	  $myDb = DBMaker::create ('ptest');
  	  Database::clearDB();
  	  $db = Database::getDB('ptest', DBMaker::$unitTestPath);
  	  $users = UsersDB::getUsersBy();
  	  $this->assertEquals(4, count($users), 
  	  		'It should fetch all of the users in the test database');

  	  foreach ($users as $user) 
          $this->assertTrue(is_a($user, 'User'), 
        		'It should return valid User objects');
  }
  
  public function testInsertValidUser() {
  	DBMaker::setConfigurationPath(DBMaker::$unitTestPath);
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', DBMaker::$unitTestPath);
  	$beforeCount = count(UsersDB::getUsersBy());
  	$validTest = array("userName" => "krobbins", "password" => "123");
  	$s1 = new User($validTest);
  	$newUser = UsersDB::addUser($s1);
  	$this->assertEquals(0, $newUser->getErrorCount(), 
  			'The inserted user should not have users');
  	$afterCount = count(UsersDB::getUsersBy());
  	$this->assertEquals($afterCount, $beforeCount + 1,
  			'The database should have one more user after insertion');
  }
  
  public function testInsertDuplicateUser() {
  	ob_start();
  	DBMaker::setConfigurationPath(DBMaker::$unitTestPath);
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', DBMaker::$unitTestPath);
  	$beforeCount = count(UsersDB::getUsersBy());
  	$duplicateTest = array("userName" => "Kay", "password" => "123");
  	$s1 = new User($duplicateTest);
  	$newUser = UsersDB::addUser($s1);
  	$this->assertGreaterThan(0, $newUser->getErrorCount(), 
  			'Duplicate attempt should return errors');
  	$afterCount = count(UsersDB::getUsersBy());
  	$this->assertEquals($afterCount, $beforeCount,
  			'The database should have the same number of elements after trying to insert duplicate');
  	ob_get_clean();
  }
  
  public function testUpdateUserName() {
  	// Test the update of the userName 
  	DBMaker::setConfigurationPath(DBMaker::$unitTestPath);
 	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', DBMaker::$unitTestPath);
	$users = UsersDB::getUsersBy('userId', 1);
	$user = $users[0];
	$parms = $user->getParameters();
	$this->assertEquals($user->getUserName(), 'Kay',
			'Before the update it should have user name Kay');
	$parms['userName'] = 'Kay1';
	$newUser = new User($parms);
	$newUser->setUserId(1);
	$user = UsersDB::updateUser($newUser);
	$this->assertEquals($user->getUserName(), 'Kay1',
			'Before the update it should have user name Kay1');
	$this->assertTrue(empty($user->getErrors()),
			'The updated user should not have errors');
  }
}
?>