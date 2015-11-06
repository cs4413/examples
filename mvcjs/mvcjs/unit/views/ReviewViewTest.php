<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Review.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\ReviewView.class.php';

class ReviewViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowReviewViewWithReview() {
  	ob_start();
  	$validTest = array("reviewerName" => "Kay",
             	       "submissionId" => "1",
	           	       "score" => "5",
		               "review" => "This was a great presentation"
		              );
    $s1 = new Review($validTest);
  	$_SESSION = array('review' => $s1, 'base' => 'mvcsession');
    ReviewView::show();
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show a ReviewView when passed a valid Review ");
  }
  
  public function testShowReviewViewWithoutReview() {
  	ob_start();	
  	$_SESSION = array('base' => 'mvcsession');
  	ReviewView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a ReviewView when Review is not defined");
  }
  
  public function testShowAllReviews() {
  	ob_start();
  	$validTest = array("reviewerName" => "Kay",
             	       "submissionId" => "2",
	           	       "score" => "5",
		               "review" => "This was a great presentation"
		              );
    $s1 = new Review($validTest);
  	$s1 -> setReviewId(1);
  	$s2 = new Review($validTest);
  	$s2 -> setReviewId(2);
  	$reviews = array($s1, $s2);
  	$_SESSION = array('reviews' => $reviews, 'base' => 'mvcsession',
  			          'headertitle' => 'Submission table',
  			          'footertitle' => 'This is a footer');
  	ReviewView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Reviews when passed valid input and a header and footer");
  }
  
  public function testShowAllReviewsWithNoReviews() {
  	ob_start();
  	$_SESSION = array('base' => 'mvcsession');
  	ReviewView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Reviews when nothing is passed");
  }
  
  public function testUpdateReview() {
  	ob_start();
  	$validTest = array("reviewerName" => "Kay",
  		 	           "submissionId" => 2,
  			           "score" => "5",
  			           "review" => "This was a great presentation"
  	);
  	$review = new Review($validTest);
  	$review->setReviewId(1);
  	$_SESSION = array('review' => $review, 'base' => "mvcsession");
  	ReviewView::showUpdate();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show an update form");
  }
}
?>