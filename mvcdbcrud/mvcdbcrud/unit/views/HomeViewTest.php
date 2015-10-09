<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\HomeView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class HomeViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowHomeViewWithUser() {
  	$validTest = array("userName" => "krobbins", "password" => "123");
  	$s1 = new User($validTest);
  	ob_start();
  	HomeView::show($s1);
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a valid user");
  }
  
  public function testShowHomeViewWithNullUser() {
  	ob_start();
  	$return = HomeView::show(null);
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a null user");
  
  }

}
?>