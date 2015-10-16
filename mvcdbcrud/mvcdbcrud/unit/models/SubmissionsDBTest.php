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
  
//   public function testInsertValidSubmission() {
//   	$myDb = DBMaker::create ('ptest');
//   	Database::clearDB();
//   	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
//   	$beforeCount = count(SubmissionsDB::getSubmissionsBy());
//   	$validTest = array("userName" => "George", "assignmentNumber" => "1",
// 		           "submissionFile" => array("name" => "myText.apl", 
// 		           		                     "tmp_name" => "temp.1"));
//   	$s1 = new Submission($validTest);
//   	$submission = SubmissionsDB::addSubmission($s1);
//   	$this->assertTrue(!is_null($submission), 'The inserted submission should not be null');
//   	$this->assertTrue(empty($submission->getErrors()), 'The returned submission should not have errors');
//   	print_r($submission->getErrors());
//   	$afterCount = count(SubmissionDB::getSubmissionsBy());
//   	$this->assertEquals($afterCount, $beforeCount + 1,
//   			'The database should have one more submission after insertion');
//   }
  
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