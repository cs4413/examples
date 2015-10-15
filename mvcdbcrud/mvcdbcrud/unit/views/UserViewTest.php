<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\UserView.class.php';

class UserViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowUserViewWithUser() {
  	ob_start();
  	$validTest = array("userName" => "krobbins", "password" => "123");
  	$s1 = new User($validTest);
  	$_SESSION = array('user' => $s1, 'base' => 'mvcdbcrud');
    UserView::show();
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show a User view when passed a valid user");
  }
  
  public function testShowUserViewWithNullUser() {
  	 ob_start();
     $_SESSION = array('user' => null, 'base' => 'mvcdbcrud');
     $return = UserView::show();
     $output = ob_get_clean();
     $this->assertFalse(empty($output),
    		"It should show a User view when passed a null user");
  }
  
  public function testShowAllUsers() {
     // Test that the showAll produces output for users
  	 ob_start();
     $s1 = new User(array("userName" => "Kay", "password" => "xxx"));
     $s1 -> setUserId(1);
     $s2 = new User(array("userName" => "John", "password" => "yyy"));
     $s2 -> setUserId(2);  
     $_SESSION['users'] = array($s1, $s2);
     $_SESSION['base'] = 'mvcdbdcrud';
     $_SESSION['arguments'] = null;
     UserView::showall();
     $output = ob_get_clean();
     $this->assertFalse(empty($output), "It should show the Users table");
  }
}
?>