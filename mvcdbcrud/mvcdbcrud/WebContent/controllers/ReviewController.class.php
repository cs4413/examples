<?php
class ReviewController {

	public static function run() {
		// Perform actions related to a review
		$action = $_SESSION['action'];
		$arguments = $_SESSION['arguments'];
		switch ($action) {
			case "new":
				self::newReview();
				break;
			case "show":
	
				break;
			case  "showall":
				$_SESSION['reviews'] = reviewsDB::getReviewsBy();
				$_SESSION['headertitle'] = "ClassBash Reviews";
				$_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
				ReviewView::showall();
				break;
			case "update":
				self::updateReview();
				break;
			default:
		}
	}
	
	
	public static function newReview() {
		// Process a new review
		$review = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST")  {
			$review = new Review($_POST);
			$reviewId = ReviewsDB::addReview($review);
		    if ($reviewId == 0)
		    	$review->setError('reviewId', 'REVIEW_IDENTITY_INVALID');
		}
		if (is_null($review) || $review->getErrorCount() != 0) {
			$_SESSION['review'] = $review;
			ReviewView::showNew();
		} else {
			HomeView::show();	
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
		}		
	}
	
	public static function showReview() {
		// Display the review indicated by the argument
		$reviews = ReviewsDB::getReviewsBy('reviewId', $_SESSION['arguments']);
		if (!empty($reviews)) {
			$_SESSION['review'] = null;
			HomeView::show();
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
	    } else {
			$_SESSION['review'] = $reviews[0];
		    ReviewView::show();
		}
	}
	
	public static function updateReview() {
		// Process updating review
		$reviews = ReviewsDB::getReviewsBy('reviewId', $_SESSION['arguments']);
		if (empty($reviews)) {
			HomeView::show();
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
		} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
			$_SESSION['review'] = $reviews[0];
			ReviewView::showUpdate();
		} else {
			$parms = $reviews[0]->getParameters();
			$parms['score'] = (array_key_exists('score', $_POST))?
			                  $_POST['score']:$reviews[0]->getScore();
			$parms['review'] = (array_key_exists('review', $_POST))?
		                    	$_POST['review']:$reviews[0]->getReview();
			$newReview = new Review($parms);
			$newReview->setReviewId($reviews[0]->getReviewId());
			$reviewId = ReviewsDB::updateReview($newReview);
			if ($reviewId == 0)
				$newReview->setError('reviewId', 'REVIEW_IDENTITY_INVALID');
		    if ($newReview->getErrorCount() != 0) {
			   $_SESSION['review'] = $newReview;
		   	   ReviewView::showUpdate();
		    } else {
			   HomeView::show();
			   header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
		    }
		}
	}
		
}
?>