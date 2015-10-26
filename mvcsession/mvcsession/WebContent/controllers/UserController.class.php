<?php
class UserController {

	public static function run() {
		// Perform actions related to a user
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		$arguments = $_SESSION['arguments'];
		switch ($action) {
			case "new":
				self::newUser();
				break;
			case "show":
				$users = UsersDB::getUsersBy('userId', $arguments);
				$_SESSION['user'] = (!empty($users))?$users[0]:null;
				self::show();
				break;
			case  "showall":
				$_SESSION['users'] = usersDB::getUsersBy();
				$_SESSION['headertitle'] = "ClassBash Reviews";
				$_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
				UserView::showall();
				break;
			case "update":
				echo "Update";
				self::updateUser();
				break;
			default:
		}
	}
	
	public static function show() {
		$arguments = (array_key_exists('arguments', $_SESSION))?$_SESSION['arguments']:0;
		$user = $_SESSION['user'];
		if (!is_null($user)) {
			$_SESSION['user'] = $user;
		    $_SESSION['userSubmissions'] =  
		        SubmissionsDB::getSubmissionsBy('submitterName', $user->getUserName());
		    $_SESSION['userReviews'] =
		        ReviewsDB::getReviewsBy('reviewerName', $user->getUserName());
		    UserView::show();
		} else
			HomeView::show();
	}
	
	public static function newUser() {
		// Process a new review
		$user = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST);  
			$user = UsersDB::addUser($user);
		}
		if (is_null($user) || $user->getErrorCount() != 0) {
			$_SESSION['user'] = $user;
			UserView::showNew();	
		} else {
			HomeView::show();
			header('Location: /'.$_SESSION['base']);
		}
	}
	
	public static function updateUser() {
		// Process updating of user information
		$users = UsersDB::getUsersBy('userId', $_SESSION['arguments']);
		if (empty($users)) {
			HomeView::show();
			header('Location: /'.$_SESSION['base']);
		} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
			$_SESSION['user'] = $users[0];
			UserView::showUpdate();
		} else {
			$parms = $users[0]->getParameters();
			$parms['userName'] = (array_key_exists('userName', $_POST))?
			                $_POST['userName']:"";
			$parms['password'] = (array_key_exists('password', $_POST))?
	                 		$_POST['password']:"";
			$newUser = new User($parms);
			$newUser->setUserId($users[0]->getUserId());
			$user = UsersDB::updateUser($newUser);
		
			if ($user->getErrorCount() != 0) {
				$_SESSION['user'] = $newUser;
				UserView::showUpdate();
			} else {
				HomeView::show();
				header('Location: /'.$_SESSION['base']);
			}
		}
	}
	
}
?>