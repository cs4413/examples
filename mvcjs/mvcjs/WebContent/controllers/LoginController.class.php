<?php
class LoginController {

	public static function run() {
		$user = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST); 
			$users = UsersDB::getUsersBy('userName', $user->getUserName());
			if (empty($users))
			    $user->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
			elseif (!$user->verifyPassword($users[0]->getPasswordHash())) {
			    $user->setError('userName', 'USER_PASSWORD_INCORRECT');
			} else
				$user = $users[0];
		}
		$_SESSION['user'] = $user;
		if (is_null($user) || $user->getErrorCount() != 0) 
		   LoginView::show();
		else {
            $_SESSION['authenticatedUser'] = $user;
		    HomeView::show();
		    header('Location: /'.$_SESSION['base']);
		}
	}
}
?>