<?php
class ReviewController {

	public static function run($sessionInfo) {
		// Perform actions related to a review
		print_r($sessionInfo);
		$action = $sessionInfo['action'];
		$arguments = $sessionInfo['arguments'];
		print_r($arguments);
		switch ($action) {
			case "new":
				echo "I'm here";
				self::newReview($sessionInfo);
				break;
			case "show":
				break;
			case  "showall":
				$sessionInfo['reviews'] = reviewsDB::getAllReviews();
				$sessionInfo['headertitle'] = "ClassBash Reviews";
				$sessionInfo['footertitle'] = "<h3>The footer goes here</h3>";
				ReviewView::showall($sessionInfo);
				break;
			default:
		}
	}
	
	
	public static function newReview($sessionInfo) {
		// Process a new submission
		echo "here again--";
		$review = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST")  
			$review = new Review($_POST);  	
		if (is_null($review) || $review->getErrorCount() != 0) {
			$sessionInfo['review'] = $review;
			echo "here";
			ReviewView::showNew($sessionInfo);
			
		} else {
			echo "Here 1";
			HomeView::show($sessionInfo);
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$sessionInfo['base']);
		}
	}
}
?>