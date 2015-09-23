<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login View</title>
</head>
<body>
<h1>Login view tests</h1>

<?php
include_once("../views/LoginView.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/User.class.php");
?>

<h2>It should call show when $user has an input</h2>
<?php 
$validTest = array("userName" => "krobbins");
$s1 = new User($validTest);
LoginView::show($s1);
?>
</body>
</html>
