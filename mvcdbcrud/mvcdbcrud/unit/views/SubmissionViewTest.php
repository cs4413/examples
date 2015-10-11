<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\SubmissionView.class.php';

class SubmissionViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowSUbmissionViewWithSubmission() {
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		               "submissionFile" => array("name" => "myText.apl", 
		           		                     "tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$sessionInfo = array('submission' => $s1, 'base' => 'mbcdbcrud');
  	ob_start();
    SubmissionView::show($sessionInfo);
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show a Submission view when passed a valid Submission and a header and footer");
  }
  
  public function testShowSubmissionViewWithoutHeaderAndFooter() {
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
  			"submissionFile" => array("name" => "myText.apl",
  					"tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$sessionInfo = array('submission' => $s1, 'base' => 'mbcdbcrud');
  	ob_start();
  	SubmissionView::show($sessionInfo);
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Submission view when passed a valid Submission");
  }
  
  public function testShowAllSubmissions() {
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
  			"submissionFile" => array("name" => "myText.apl",
  					"tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$s1 -> setSubmissionId(1);
  	$submissions = array($s1, $s1);
  	$sessionInfo = array('submissions' => $submissions, 'base' => 'mbcdbcrud');
  	ob_start();
  	SubmissionView::showall($sessionInfo);
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Submissions when passed valid input and a header and footer");
  }
  
  public function testShowAllSubmissionsWithNoHeaderAndFooter() {
  	$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
  			"submissionFile" => array("name" => "myText.apl",
  					"tmp_name" => "temp.1"));
  	$s1 = new Submission($validTest);
  	$s1 -> setSubmissionId(1);
  	$submissions = array($s1, $s1);
  	$sessionInfo = array('submissions' => $submissions, 'base' => 'mvcdbcrud');
  	ob_start();
  	SubmissionView::showall($sessionInfo);
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Submissions when passed valid input and a header and footer");
  }
}
?>