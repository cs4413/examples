<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\InformationView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class InformationViewTest extends PHPUnit_Framework_TestCase {
	protected $base = 'mvcjs';
	
  public function testShowInformationView() {
  	ob_start();
  	$_SESSION = array("base" => $this->base);
  	InformationView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show an InformationView ");
  }

}
?>