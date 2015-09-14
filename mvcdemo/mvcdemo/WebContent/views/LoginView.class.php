<?php  
class LoginView {
	
  public static function show($user) {  	
?> 
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Login for ClassBash</title>
</head>
<body>
<h1>Login new user sign-up</h1>

<section>
<form method="post" action = "../controllers/login.php">
<p>
User name:
<input type="text" name="userName" value = "<?php echo $user->getUserName();?>" required>
<br> <br>
<input type="submit" value="Submit">
</form>
</section>


</body>
<?php 
  }
}
?>
</html>