<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\SubmissionsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\DBMaker.php';


class SubmissionsDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllSubmissions() {
  	  $myDb = DBMaker::create ('ptest');
  	  Database::clearDB();
  	  $db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	  $submissions = SubmissionsDB::getSubmissionsBy();
  	  $this->assertEquals(3, count($submissions), 
  	  		'It should fetch all of the submissions in the test database');

  	  foreach ($submissions as $submission) 
          $this->assertTrue(is_a($submission, 'Submission'), 
        		'It should return valid Submission objects');
  }
  
  public function testInsertValidSubmission() {
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	$beforeCount = count(SubmissionsDB::getSubmissionsBy());
    $validTest = array("submitterName" => "George", "assignmentNumber" => "1",
  		                "submissionFile" => "myText.apl");
  	$s1 = new Submission($validTest);
  	$submission = SubmissionsDB::addSubmission($s1);
  	$this->assertTrue(!is_null($submission), 'The inserted submission should not be null');

  	$this->assertTrue(empty($submission->getErrors()), 'The returned submission should not have errors');
  	$afterCount = count(SubmissionsDB::getSubmissionsBy());
  	$this->assertEquals($afterCount, $beforeCount + 1,
  			'The database should have one more submission after insertion');
  }
  
  public function testInsertDuplicateSubmission() {
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	$beforeCount = count(SubmissionsDB::getSubmissionsBy());
    $duplicateTest =  array("submitterName" => "Kay", "assignmentNumber" => "1",
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
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
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
  

  
//   public function testInsertDuplicateReview() {
//   	ob_start();
//   	$myDb = DBMaker::create ('ptest');
//   	Database::clearDB();
//   	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
//   	$beforeCount = count(ReviewsDB::getReviewsBy());
//   	$duplicateTest =  	$validTest = array("reviewerName" => "John",
//   			"submissionId" => "1",
//   			"score" => "5",
//   			"review" => "This was a great presentation"
//   	);
//   	$s1 = new Review($duplicateTest);
//   	$review = ReviewsDB::addReview($s1);
//   	$this->assertTrue(!is_null($review), 'The returned review should not be null');
//   	$this->assertTrue(!empty($review->getErrors()), 'The returned review should have errors');
//   	$afterCount = count(ReviewsDB::getReviewsBy());
//   	$this->assertEquals($afterCount, $beforeCount,
//   			'The database should have the same number of reviews after trying to insert duplicate');
//   	ob_get_clean();
//   }

}
?>