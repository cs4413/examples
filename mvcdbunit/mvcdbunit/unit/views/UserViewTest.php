<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\UserView.class.php';

class UserViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowUserViewWithUser() {
  	$validTest = array("userName" => "krobbins", "password" => "123");
  	$s1 = new User($validTest);
  	ob_start();
    UserView::show($s1);
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show a User view when passed a valid user");
  }
  
  public function testShowUserViewWithNullUser() {
  	 ob_start();
     $return = UserView::show(null);
     $output = ob_get_clean();
     $this->assertFalse(empty($output),
    		"It should show a User view when passed a null user");
  
  }

}
?>