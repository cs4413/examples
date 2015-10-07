<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\makeDB.php';


class UsersDBTest extends PHPUnit_Framework_TestCase {
	
  public function testValidUserCreate() {
// //    $myDb = makeDB ( 'ptest' );
//    	$users = UsersDB::getAllUsers();
//    	$userCount = count($users);
//   	$this->assertEquals($userCount, 4, "It should create the correct number of users");
//   	foreach ($users as $user) 
//         $this->assertTrue(is_a($user, 'User'), 'It should retrieve a valid User object');
  }
}
?>