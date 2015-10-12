<?php
require_once dirname(__FILE__). '\..\..\WebContent\models\Messages.class.php';                     

class MessagesTest extends PHPUnit_Framework_TestCase {
  
  public function testHasAMessage() {
  	Messages::reset();
  	$errorMessage = Messages::getError("EMAIL_INVALID");
    $this->assertTrue(!empty($errorMessage), 
    	'It should have an error messages for an invalid email');
  }
  
  public function testHasNoMessage() {
  	Messages::reset();
  	$errorMessage = Messages::getError("GIANTS_ARE_HERE");
  	$this->assertTrue(empty($errorMessage),
  			'It should not have an error messages for giants');
  }

}
?>