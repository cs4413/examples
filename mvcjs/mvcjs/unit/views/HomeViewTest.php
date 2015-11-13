<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\HomeView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class HomeViewTest extends PHPUnit_Framework_TestCase {
	protected $base = 'mvcjs';
	
  public function testShowHomeViewWithUser() {
  	ob_start();
  	$validTest = array('userName' => 'krobbins', 'password' => '123');
  	$s1 = new User($validTest);
  	$_SESSION = array('user' => $s1, 'base' => $this->base);
  	HomeView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a valid user");
  }
  
  public function testShowHomeViewWithNullUser() {
  	ob_start();
  	$_SESSION = array('user' => null, 'base' => $this->base);
  	$return = HomeView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a null user");
  }

}
?>