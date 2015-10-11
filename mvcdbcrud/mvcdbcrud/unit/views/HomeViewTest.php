<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\HomeView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class HomeViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowHomeViewWithUser() {
  	$validTest = array('userName' => 'krobbins', 'password' => '123');
  	$s1 = new User($validTest);
  	$sessionInfo = array('user' => $s1, 'base' => 'mvcdbcrud');
  	ob_start();
  	HomeView::show($sessionInfo);
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a valid user");
  }
  
  public function testShowHomeViewWithNullUser() {
  	$sessionInfo = array('user' => null, 'base' => 'mvcdbcrud');
  	ob_start();
  	$return = HomeView::show($sessionInfo);
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a null user");
  
  }

}
?>