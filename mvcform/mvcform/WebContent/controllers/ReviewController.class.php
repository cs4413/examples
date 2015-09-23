<?php
class ReviewController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$review = new Review($_POST);  
			if ($review->getErrorCount() == 0) 
				HomeView::show(null);		
		    else  
				ReviewView::show($review);
		} else  // Initial link
			ReviewView::show(null);
	}
}
?>