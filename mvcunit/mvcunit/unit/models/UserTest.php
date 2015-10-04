<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';

class UserTest extends PHPUnit_Framework_TestCase {
	
  public function testValidUserCreate() {
  	$validTest = array("userName" => "krobbins", "password" => "123");
  	$s1 = new User($validTest);
    $this->assertTrue(is_a($s1, 'User'), 
    	'It should create a valid User object when valid input is provided');
    
  }

}
?>