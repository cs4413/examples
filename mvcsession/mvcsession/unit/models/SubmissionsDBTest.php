<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Configuration.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\SubmissionsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';
require_once dirname(__FILE__).'\DBMakerUnit.class.php';

class SubmissionsDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllSubmissions() {
  	  DBMakerUnit::createDB('ptest');
  	  $submissions = SubmissionsDB::getSubmissionsBy();
  	  $this->assertEquals(3, count($submissions), 
  	  		'It should fetch all of the submissions in the test database');

  	  foreach ($submissions as $submission) 
          $this->assertTrue(is_a($submission, 'Submission'), 
        		'It should return valid Submission objects');
  }
  
  public function testInsertValidSubmission() {
  	DBMakerUnit::createDB('ptest');
  	Configuration::setUploadPath(DBMakerUnit::$unitUploadPath);
  	$beforeCount = count(SubmissionsDB::getSubmissionsBy());
  	$_FILES['submissionFile'] = array('name' => 'V:\test.txt',
  			                          'tmp_name' => 'V:\testtemp.txt');
  	$this->assertTrue(copy($_FILES['submissionFile']['name'], $_FILES['submissionFile']['tmp_name']),
  	     'It should have a temporary file to copy');
    $validTest = array("submitterName" => "George", 
    		           "assignmentId" => "1");
  	$s1 = new Submission($validTest);
  	$submission = SubmissionsDB::addSubmission($s1);
  	$this->assertTrue(!is_null($submission), 'The inserted submission should not be null');
  	$this->assertTrue(!empty($submission->getSubmissionFile()), 'The returned submission should have a file name');
  	$this->assertTrue(!empty($submission->getError('submissionFile')), 
  			'The unit test does not allow upload');
  	$this->assertEquals($submission->getErrorCount(), 1, 'The only error should be file upload');
  }
  
  public function testInsertDuplicateSubmission() {
  	DBMakerUnit::createDB('ptest');
  	$beforeCount = count(SubmissionsDB::getSubmissionsBy());
    $duplicateTest =  array("submitterName" => "Kay", "assignmentId" => "1",
		           "submissionFile" =>  "V:\test.txt");
  	$s1 = new Submission($duplicateTest);
  	$submission = SubmissionsDB::addSubmission($s1);
  	$this->assertTrue(!is_null($submission), 'The returned submission should not be null');
  	$this->assertTrue(!empty($submission->getErrors()), 'The returned submission should have errors');
  	$afterCount = count(SubmissionsDB::getSubmissionsBy());
  	$this->assertEquals($afterCount, $beforeCount,
  			'The database should have the same number of submissions after trying to insert duplicate');
  }
  
  public function testUpdateSubmission() {
  	DBMakerUnit::createDB('ptest');
  	$beforeCount = count(SubmissionsDB::getSubmissionsBy());
  	$submissions = SubmissionsDB::getSubmissionsBy('submissionId', 1);
  	$currentSubmission = $submissions[0];
  	$parms = $currentSubmission->getParameters();
  	$parms['submissionFile'] = 'newFile.txt';
  	$newSubmission = new Submission($parms);
  	$newSubmission->setSubmissionId($currentSubmission->getSubmissionId());
  	$updatedSubmission = SubmissionsDB::updateSubmission($newSubmission);
  	$afterCount = count(SubmissionsDB::getSubmissionsBy());
  	$this->assertEquals($beforeCount, $afterCount,
  			'The number of submission in the database should not change after update');
  	$this->assertEquals($updatedSubmission->getSubmissionId(), $newSubmission->getSubmissionId(),
  			'The id of the updated submission should remain the same');
  }
  
  public function testGetSubmissionBySubmitterName() {
 	DBMakerUnit::createDB('ptest');
    $submissions = SubmissionsDB::getSubmissionsBy('submitterName', 'Kay');
    $this->assertEquals(count($submissions), 2, 'Kay should have two submissions');
    foreach($submissions as $submission) {
    	$this->assertTrue(is_a($submission, "Submission"),
    			'The returned values should be Submission objects');
    	$this->assertTrue(empty($submission->getErrors()), 
    			"The returned submissions should have no errors");
    }
  }

}
?>