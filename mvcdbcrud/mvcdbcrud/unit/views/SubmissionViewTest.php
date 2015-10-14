<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\SubmissionView.class.php';

class SubmissionViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowSubmissionViewWithSubmission() {
  	ob_start();
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		               "submissionFile" => array("name" => "myText.apl", 
		           		                     "tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$_SESSION = array('submission' => $s1, 'base' => 'mbcdbcrud');
    SubmissionView::show();
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show a Submission view when passed a valid Submission and a header and footer");
  }
  
  public function testShowSubmissionViewWithoutHeaderAndFooter() {
  	ob_start();
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
  			"submissionFile" => array("name" => "myText.apl",
  					"tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$_SESSION = array('submission' => $s1, 'base' => 'mbcdbcrud');

  	SubmissionView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Submission view when passed a valid Submission");
  }
  
  public function testShowAllSubmissions() {
  	ob_start();
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
  			"submissionFile" => array("name" => "myText.apl",
  					"tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$s1 -> setSubmissionId(1);
  	$submissions = array($s1, $s1);
  	$_SESSION = array('submissions' => $submissions, 'base' => 'mbcdbcrud');
  	SubmissionView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Submissions when passed valid input and a header and footer");
  }
  
  public function testShowAllSubmissionsWithNoHeaderAndFooter() {
  	ob_start();
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
  			"submissionFile" => array("name" => "myText.apl",
  					"tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$s1 -> setSubmissionId(1);
  	$submissions = array($s1, $s1);
  	$_SESSION = array('submissions' => $submissions, 'base' => 'mvcdbcrud');

  	SubmissionView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Submissions when passed valid input and a header and footer");
  }
  
  public function testUpdateSubmission() {
  	  ob_start();
      $validSubmission = array("userName" => "krobbins", "assignmentNumber" => "1",
  		     "submissionFile" => array("name" => "myText.apl", "tmp_name" => "temp.1"));
      $s1 = new Submission($validSubmission);
      $s1->setSubmissionId(1);
      $_SESSION = array('submission' => $s1, 'base' => "mvcdbcrud");
      SubmissionView::showUpdate();
  	  $output = ob_get_clean();
      $this->assertFalse(empty($output), "It should show an update form");
  }
}
?>