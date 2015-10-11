<?php
class LoginController {

	public static function run($sessionInfo) {
		$user = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST); 
			$users = UsersDB::getUsersBy('userName', $user->getUserName());
			if (empty($users))
			    $user->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
			else 
				$user = $users[0];
		}
		$sessionInfo['user'] = $user;
		if (is_null($user) || $user->getErrorCount() != 0) 
		   LoginView::show($sessionInfo);
		else  {
		   HomeView::show($sessionInfo);
		   header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$sessionInfo['base']);
		}
	}
}
?>