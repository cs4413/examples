<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';

class SubmissionTest extends PHPUnit_Framework_TestCase {
	
  public function testValidSubmissionCreate() {
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", 
		           		                     "tmp_name" => "temp.1"));
    $s1 = new Submission($validTest);
    $this->assertTrue(is_a($s1, 'Submission'),
		'It should create a valid Submission object when valid input is provided');

  }
  
}
?>