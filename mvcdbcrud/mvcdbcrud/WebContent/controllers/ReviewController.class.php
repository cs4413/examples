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
				$reviews = ReviewsDB::getReviewsBy('reviewId', $arguments);
				$_SESSION['review'] = (!empty($reviews))?$reviews[0]:null;
	            ReviewView::show();
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
			$review = ReviewsDB::addReview($review);
		}
		if (is_null($review) || $review->getErrorCount() != 0) {
			$_SESSION['review'] = $review;
			ReviewView::showNew();
		} else {
			HomeView::show();	
			header('Location: /'.$_SESSION['base']);
		}		
	}
	

	public static function updateReview() {
		// Process updating review
		$reviews = ReviewsDB::getReviewsBy('reviewId', $_SESSION['arguments']);
		if (empty($reviews)) {
			HomeView::show();
			header('Location: /'.$_SESSION['base']);
		} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
			$_SESSION['reviews'] = $reviews;
			ReviewView::showUpdate();
		} else {

			$parms = $reviews[0]->getParameters();
			$parms['score'] = (array_key_exists('score', $_POST))?
			                  $_POST['score']:$reviews[0]->getScore();
			$parms['review'] = (array_key_exists('review', $_POST))?
		                    	$_POST['review']:$reviews[0]->getReview();
			$newReview = new Review($parms);
			$newReview->setReviewId($reviews[0]->getReviewId());
			$review = ReviewsDB::updateReview($newReview);
		
		    if ($review->getErrorCount() != 0) {
			   $_SESSION['review'] = $newReview;
		   	   ReviewView::showUpdate();
		    } else {
			   HomeView::show();
			   header('Location: /'.$_SESSION['base']);
		    }
		}
	}
		
}
?>