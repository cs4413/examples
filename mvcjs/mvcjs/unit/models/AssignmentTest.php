<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Assignment.class.php';

class AssignmentTest extends PHPUnit_Framework_TestCase {
	
  public function testValidAssignmentCreate() {
  	ob_start();
    $validTest = array("assignmentDescription" => "This is a description of the assignment",
    	           	"assignmentTitle" => "This is an assignment title",
             	   "assignmentOwnerName" => "George");
    $s1 = new Assignment($validTest);   
    $this->assertTrue(is_a($s1, 'Assignment'), 
    	'It should create a valid Assignment object when valid input is provided');
    $this->assertEquals($s1->getErrorCount(), 0, 
    		'It should not have errors when creating a valid assignment');
    ob_end_flush();
  }

  
  public function testInvalidAssignmentCreate() {
  	ob_start();
  	$invalidTest = array("assignmentOwnerName" => 'Kay$');
  	$s1 = new Assignment($invalidTest);
  	$this->assertTrue(is_a($s1, 'Assignment'),
  			'It should create a valid Assignment object when invalid input is provided');
  	$this->assertGreaterThan(0, $s1->getErrorCount(),  
  	        'It should have errors with in valid input');
  	ob_end_flush();
  }

}
?>