<?php
class HomeView {
  public static function show($user) {  
		
?>
	<!DOCTYPE html>
	<html>
	<head>
	<title>ClassBash Home Page</title>
	</head>
	<body>
	<h1>ClassBash: A site for student peer review</h1>
	<em>Peer reviewing is really nice.</em>
	
	<h3><a href="login">Would you like to login?</a></h3>  
	
	<h3><a href="review">Would you like to review?</a></h3> 
	
	<h3><a href="tests.html">Would you like to run the tests?</a></h3> 
	 
	<h3>The footer goes here</h3>	
	</body>
	</html>
<?php
  }
}
?>