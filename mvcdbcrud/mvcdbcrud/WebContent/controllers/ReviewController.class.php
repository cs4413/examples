<?php
class ReviewController {

	public static function run($sessionInfo) {
		$review = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST")  
			$review = new Review($_POST);  
		
		if (is_null($review) || $review->getErrorCount() != 0) {
			$sessionInfo['review'] = $review;
			reviewView::showNew($sessionInfo);
		} else
			HomeView::show($sessionInfo);
	}
}
?>