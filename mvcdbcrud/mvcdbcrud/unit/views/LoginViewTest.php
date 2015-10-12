<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\LoginView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class LoginViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowLoginViewWithUser() {
  	$validTest = array("userName" => "krobbins", "password" => "123");
  	$s1 = new User($validTest);
  	$_SESSION = array('user' => $s1, 'base' => 'mbcdbcrud');
  	ob_start();
  	LoginView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Login view when passed a valid user");
  }
  
  public function testShowLoginViewWithNullUser() {
  	$_SESSION = array('base' => 'mbcdbcrud');
  	ob_start();
  	$return = LoginView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Login view when passed a null user");
  }

}
?>