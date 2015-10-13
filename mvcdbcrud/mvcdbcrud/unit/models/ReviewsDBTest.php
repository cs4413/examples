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

}
?>