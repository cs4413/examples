<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Home View</title>
</head>
<body>
<h1>Home view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/User.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/MasterView.class.php");
?>

<h2>It should call show without crashing</h2>
<?php 
$_SESSION = array("base" => "mvcdbcrud");
HomeView::show();
?>

<h2>It should say hello x if user exists</h2>
<?php 
$validTest = array("userName" => "krobbins", "password" => "123");
$s1 = new User($validTest);
$_SESSION = array("user" => $s1, "base" => "mvcdbcrud");
HomeView::show();
?>
</body>
</html>
