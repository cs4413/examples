<?php
class ReviewController {

	public static function run($sessionInfo) {
		// Perform actions related to a review
		$action = $sessionInfo['action'];
		$arguments = $sessionInfo['arguments'];
		switch ($action) {
			case "new":
				self::newReview($sessionInfo);
				break;
			case "show":
				if (!is_null($arguments) && $arguments > 0) {
				   $reviews = ReviewsDB::getReviewsBy('reviewId', $arguments);
				   $sessionInfo['review'] = (!empty($reviews))?$reviews[0]:null;
				   ReviewView::show($sessionInfo);
				}
				break;
			case  "showall":
				$sessionInfo['reviews'] = reviewsDB::getAllReviews();
				$sessionInfo['headertitle'] = "ClassBash Reviews";
				$sessionInfo['footertitle'] = "<h3>The footer goes here</h3>";
				ReviewView::showall($sessionInfo);
				break;
			case "update":
				break;
			default:
		}
	}
	
	
	public static function newReview($sessionInfo) {
		// Process a new submission
		$review = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST")  
			$review = new Review($_POST);  
		echo "in new review: $review";

		if (is_null($review) || $review->getErrorCount() != 0) {
			$sessionInfo['review'] = $review;
			ReviewView::showNew($sessionInfo);	
		} else {
			HomeView::show($sessionInfo);
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$sessionInfo['base']);
		}
	}
}
?>