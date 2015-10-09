<?php
class LoginController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST);  
			if ($user->getErrorCount() != 0) 
				LoginView::show($user);
			else {
				$users = UsersDB::getUsersBy('userName', $user->getUserName());
			    if (!empty($users)) 
				   HomeView::show($users[0]);		
		        else {
		           $user->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
				   LoginView::show($user);
		        }
		     } 
		} else  // Initial link
			LoginView::show(null);
	}
}
?>