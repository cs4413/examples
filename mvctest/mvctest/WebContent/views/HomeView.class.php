<?php

class HomeView {

  public static function show() {  
		
?>
	
	<!DOCTYPE html>
	<html>
	<head>
	<title>ClassBash Home Page</title>
	</head>
	<body>
	<h1>ClassBash: A site for student peer review</h1>
	<em>Peer reviewing is really nice.</em>
	
	<h3><a href="register">Register as a new user</a></h3>
	
	<h3><a href="login">Login</a></h3>
	
	<h3>The footer goes here</h3>
	
	</body>
	</html>
<?php
echo "I'm the home page";
  }
}
?>