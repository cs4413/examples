<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Review.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\ReviewsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\SubmissionsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\DBMaker.php';


class ReviewsDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllReviews() {
  	  $myDb = DBMaker::create ('ptest');
  	  Database::clearDB();
  	  $db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	  $reviews = ReviewsDB::getReviewsBy();
  	  $this->assertEquals(8, count($reviews), 
  	  		'It should fetch all of the reviews in the test database');

  	  foreach ($reviews as $review) 
          $this->assertTrue(is_a($review, 'Review'), 
        		'It should return valid Review objects');
  }
  
  public function testInsertValidReview() {
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	$beforeCount = count(ReviewsDB::getReviewsBy());
  	$validTest = array("userName" => "Kay",
  			"submissionId" => "1",
  			"score" => "5",
  			"review" => "This was a great presentation"
  	);
  	$s1 = new Review($validTest);
  	$reviewId = ReviewsDB::addReview($s1);
  	$this->assertGreaterThan(0, $reviewId, 'The inserted review id should be positive');
  	$afterCount = count(ReviewsDB::getReviewsBy());
  	$this->assertEquals($afterCount, $beforeCount + 1,
  			'The database should have one more review after insertion');
  }
  
  public function testInsertDuplicateReview() {
  	ob_start();
  	$myDb = DBMaker::create ('ptest');
  	Database::clearDB();
  	$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	$beforeCount = count(ReviewsDB::getReviewsBy());
  	$duplicateTest =  	$validTest = array("userName" => "John",
  		                           	       "submissionId" => "1",
  			                               "score" => "5",
  			                               "review" => "This was a great presentation"
  	);
  	$s1 = new Review($duplicateTest);
  	$reviewId = ReviewsDB::addReview($s1);
  	$this->assertEquals(0, $reviewId, 'Duplicate attempt should return 0 reviewId');
  	$afterCount = count(ReviewsDB::getReviewsBy());
  	$this->assertEquals($afterCount, $beforeCount,
  			'The database should have the same number of reviews after trying to insert duplicate');
  	ob_get_clean();
  }

}
?>