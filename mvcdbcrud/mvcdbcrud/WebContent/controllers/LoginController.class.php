<?php
class LoginController {

	public static function run() {
		$user = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST); 
			print_r($user);
			echo "in post";
			$users = UsersDB::getUsersBy('userName', $user->getUserName());
			if (empty($users))
			    $user->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
			else 
				$user = $users[0];
			echo "IN post";
		}
		$_SESSION['user'] = $user;
		if (is_null($user) || $user->getErrorCount() != 0) 
		   LoginView::show();
		else  {
			echo"About to show home ".$_SESSION['user'];
		    HomeView::show();
		    header('Location: /'.$_SESSION['base']);
		}
	}
}
?>