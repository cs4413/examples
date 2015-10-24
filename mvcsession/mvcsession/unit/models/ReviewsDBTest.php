<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Review.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\ReviewsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\SubmissionsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';
require_once dirname(__FILE__).'\DBMakerUnit.class.php';

class ReviewsDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllReviews() {
  	  DBMakerUnit::createDB('ptest');
  	  $reviews = ReviewsDB::getReviewsBy();
  	  $this->assertEquals(8, count($reviews), 
  	  		'It should fetch all of the reviews in the test database');

  	  foreach ($reviews as $review) 
          $this->assertTrue(is_a($review, 'Review'), 
        		'It should return valid Review objects');
  }
  
  public function testInsertValidReview() {
    DBMakerUnit::createDB('ptest');
  	$beforeCount = count(ReviewsDB::getReviewsBy());
  	$validTest = array("reviewerName" => "Kay",
  			"submissionId" => "1",
  			"score" => "5",
  			"review" => "This was a great presentation"
  	);
  	$s1 = new Review($validTest);
  	$review = ReviewsDB::addReview($s1);
  	$this->assertTrue(!is_null($review), 'The inserted review should not be null');
  	$this->assertTrue(empty($review->getErrors()), 'The returned review should not have errors');
  	$afterCount = count(ReviewsDB::getReviewsBy());
  	$this->assertEquals($afterCount, $beforeCount + 1,
  			'The database should have one more review after insertion');
  }
  
  public function testInsertDuplicateReview() {
  	DBMakerUnit::createDB('ptest');
  	$beforeCount = count(ReviewsDB::getReviewsBy());
  	$duplicateTest =  	$validTest = array("reviewerName" => "John",
  		                           	       "submissionId" => "1",
  			                               "score" => "5",
  			                               "review" => "This was a great presentation"
  	);
  	$s1 = new Review($duplicateTest);
  	$review = ReviewsDB::addReview($s1);
  	$this->assertTrue(!is_null($review), 'The returned review should not be null');
  	$this->assertTrue(!empty($review->getErrors()), 'The returned review should have errors');
  	$afterCount = count(ReviewsDB::getReviewsBy());
  	$this->assertEquals($afterCount, $beforeCount,
  			'The database should have the same number of reviews after trying to insert duplicate');
  }
  
  public function testUpdateReview() {
  	 DBMakerUnit::createDB('ptest');
  	 $beforeCount = count(ReviewsDB::getReviewsBy());
	 $reviews = ReviewsDB::getReviewsBy('reviewId', 1);
	 $currentReview = $reviews[0];
	 $parms = $currentReview->getParameters();
	 $parms['review'] = 'new review text';
	 $newReview = new Review($parms);
	 $newReview->setReviewId($currentReview->getReviewId());
	 $updatedReview = ReviewsDB::updateReview($newReview);
	 $afterCount = count(ReviewsDB::getReviewsBy());
	 $this->assertEquals($beforeCount, $afterCount, 
	 		'The number of reviews in the database should not change after update');
	 $this->assertEquals($updatedReview->getReviewId(), $newReview->getReviewId(),
	 		'The id of the updated review should remain the same'); 
  }

  public function testGetReviewByReviewerName() {
  	DBMakerUnit::createDB('ptest');
    $reviews = ReviewsDB::getReviewsBy('reviewerName', 'Alice');
    $this->assertEquals(count($reviews), 3, 'Alice should have three reviews');
    foreach($reviews as $review) {
    	$this->assertTrue(is_a($review, "Review"),
    			'The returned values should be Review objects');
    	$this->assertTrue(empty($review->getErrors()), 
    			"The returned reviews should have no errors");
    }
  }
}
?>