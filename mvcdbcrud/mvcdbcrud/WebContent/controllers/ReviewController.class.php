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
				if (!is_null($arguments) && $arguments > 0) {
				   $reviews = ReviewsDB::getReviewsBy('reviewId', $arguments);
				   $_SESSION['review'] = (!empty($reviews))?$reviews[0]:null;
				   ReviewView::show();
				}
				break;
			case  "showall":
				$_SESSION['reviews'] = reviewsDB::getAllReviews();
				$_SESSION['headertitle'] = "ClassBash Reviews";
				$_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
				ReviewView::showall();
				break;
			case "update":
				break;
			default:
		}
	}
	
	
	public static function newReview() {
		// Process a new submission
		$review = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST")  
			$review = new Review($_POST);  
		echo "in new review: $review";

		if (is_null($review) || $review->getErrorCount() != 0) {
			$_SESSION['review'] = $review;
			ReviewView::showNew();	
		} else {
			HomeView::show();
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
		}
	}
}
?>