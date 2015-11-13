<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\SubmissionView.class.php';

class SubmissionViewTest extends PHPUnit_Framework_TestCase {
	protected $base = 'mvcjs';
	
  public function testShowSubmissionViewWithSubmission() {
  	ob_start();
  	$validTest = array("submitterName" => "krobbins", "assignmentId" => "1",
		               "submissionFile" => "myText.apl");
  	$s1 = new Submission($validTest);
  	$_SESSION = array('submission' => $s1, 'base' => $this->base);
    SubmissionView::show();
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show a Submission view when passed a valid Submission and a header and footer");
  }
  
  public function testShowSubmissionViewWithoutHeaderAndFooter() {
  	ob_start();
  	$validTest = array("submitterName" => "krobbins", "assignmentId" => "1",
  			"submissionFile" =>  "myText.apl");
  	$s1 = new Submission($validTest);
  	$_SESSION = array('submission' => $s1, 'base' => $this->base);

  	SubmissionView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Submission view when passed a valid Submission");
  }
  
  public function testShowAllSubmissions() {
  	ob_start();
  	$validTest = array("submitterName" => "krobbins", "assignmentId" => "1",
  			"submissionFile" =>  "myText.apl");
  	$s1 = new Submission($validTest);
  	$s1 -> setSubmissionId(1);
  	$submissions = array($s1, $s1);
  	$_SESSION = array('submissions' => $submissions, 'base' => $this->base);
  	SubmissionView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Submissions when passed valid input and a header and footer");
  }
  
  public function testShowAllSubmissionsWithNoHeaderAndFooter() {
  	ob_start();
  	$validTest = array("submitterName" => "krobbins", "assignmentId" => "1",
  			"submissionFile" => "myText.apl");
  	$s1 = new Submission($validTest);
  	$s1 -> setSubmissionId(1);
  	$submissions = array($s1, $s1);
  	$_SESSION = array('submissions' => $submissions, 'base' => $this->base);

  	SubmissionView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Submissions when passed valid input and a header and footer");
  }
  
  public function testUpdateSubmission() {
  	  ob_start();
      $validSubmission = array("submitterName" => "krobbins", "assignmentId" => "1",
  		     "submissionFile" => "myText.apl");
      $s1 = new Submission($validSubmission);
      $s1->setSubmissionId(1);
      $_SESSION = array('submission' => $s1, 'base' => $this->base);
      SubmissionView::showUpdate();
  	  $output = ob_get_clean();
      $this->assertFalse(empty($output), "It should show an update form");
  }
  
  public function testNewSubmission() {
  	ob_start();
  	$validSubmission = array("submitterName" => "krobbins", "assignmentId" => "1",
  			"submissionFile" => "myText.apl");
  	$s1 = new Submission($validSubmission);
  	$_SESSION = array('submission' => $s1, 'base' => $this->base);
  	SubmissionView::showNew();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output), "It should show a new form");
  }
  
}
?>