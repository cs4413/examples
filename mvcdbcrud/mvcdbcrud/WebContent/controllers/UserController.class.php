<?php
class UserController {

	public static function run() {
		// Perform actions related to a user
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		switch ($action) {
			case "new":
				self::newUser();
				break;
			case "show":
				self::show();
				break;
			case  "showall":
				$_SESSION['users'] = usersDB::getUsersBy();
				$_SESSION['headertitle'] = "ClassBash Reviews";
				$_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
				UserView::showall();
				break;
			case "update":
				break;
			default:
		}
	}
	
	public static function show() {
		$arguments = (array_key_exists('arguments', $_SESSION))?$_SESSION['arguments']:0;
		$users = UsersDB::getUsersBy('userId', $arguments);	
		$user = (!empty($users))?$users[0]:null;
		if (!is_null($user)) {
			$_SESSION['user'] = $user;
		    $_SESSION['userSubmissions'] =  
		        SubmissionsDB::getSubmissionsBy('userName', $user->getUserName());
		    $_SESSION['userReviews'] =
		        ReviewsDB::getReviewsBy('userName', $user->getUserName());
		    UserView::show();
		} else
			HomeView::show();
	}
	
	public static function newUser() {
		// Process a new review
// 		$review = null;
// 		if ($_SERVER["REQUEST_METHOD"] == "POST")  
// 			$review = new Review($_POST);  
// 		if (is_null($review) || $review->getErrorCount() != 0) {
// 			$_SESSION['review'] = $review;
// 			ReviewView::showNew();	
// 		} else {
// 			HomeView::show();
// 			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
// 		}
	}
}
?>