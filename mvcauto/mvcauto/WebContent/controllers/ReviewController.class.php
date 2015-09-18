<?php
class ReviewController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			HomeView::show();
		} else  // Initial link
			ReviewView::show();
	 }
}
?>