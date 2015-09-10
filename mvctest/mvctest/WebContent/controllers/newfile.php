<?php
class LoginController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = new User($_POST);  // What if already logged in?
			if ($user->getErrorCount() == 0) 
				UserView::show($user);		
		    else  
				LoginView::show($user);
		} else { // Initial link
			$user = new User();
			LoginForm::show($user);
		}
	}
}
?>