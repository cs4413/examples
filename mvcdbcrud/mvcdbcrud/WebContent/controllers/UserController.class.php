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
			echo "User: $user<br>";
		    $_SESSION['userSubmissions'] =  
		        SubmissionsDB::getSubmissionsBy('submitterName', $user->getUserName());
		    $_SESSION['userReviews'] =
		        ReviewsDB::getReviewsBy('reviewerName', $user->getUserName());
		    print_r($_SESSION);
		    echo "Submissions: ".$_SESSION['userSubmissions']."<br>";
		    UserView::show();
		} else
			HomeView::show();
	}
	
	public static function newUser() {
		// Process a new review
		$user = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST")  
			$user = new User($_POST);  
		if (is_null($user) || $user->getErrorCount() != 0) {
			$_SESSION['user'] = $user;
			UserView::show();	
		} else {
			HomeView::show();
			header('Location: /'.$_SESSION['base']);
		}
	}
}
?>