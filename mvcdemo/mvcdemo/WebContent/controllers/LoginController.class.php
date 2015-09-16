<?php
class LoginController {
	public static function run() {
		include '../models/User.class.php';
		$inputForm = ($_SERVER ["REQUEST_METHOD"] == "POST") ? $_POST : null;
		$user = new User ( $inputForm );
		
		include '../views/LoginView.class.php';
		LoginView::show ( $user );
	}
}
?>
 