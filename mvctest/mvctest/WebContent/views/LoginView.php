<?php  
class LoginView {
	
  public static function show($user) {  	
?> 
	<!DOCTYPE html>
	<html>
	<head>
	<title>URL NOSH Login Form</title>
	<meta name= "keywords" content=" ClassBash login">
	<meta name="description" content = "Login for ClassBash">
	</head>
	<body>
	<form action ="LoginController" method="Post">
	<p>User name: <input type="text" name ="userName" 
	<?php if (!is_null($user)) {echo 'value = "'. $user->getUserName() .'"';}?>> 
	<span class="error">
	   <?php if (!is_null($user)) {echo $user->getError("userName");}?>
	</span></p>
	
	<p><input type = "submit" name = "submit" value="Submit"></p>
	</form>
	
	<p>New user?  <a href="../controllers/registerController.php">Sign up here</a></p>
	
	<p>Forget your password?  Well good luck with that.... </p>
    </body>
    </html>
<?php 
  }
}
?>