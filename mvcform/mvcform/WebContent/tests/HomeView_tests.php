<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Home View</title>
</head>
<body>
<h1>Home view tests</h1>

<?php
include_once("../views/HomeView.class.php");
include_once("../models/User.class.php");
?>

<h2>It should call show without crashing</h2>
<?php 
HomeView::show(null);
?>

<h2>It should say hello x if user exists</h2>
<?php 
$validTest = array("userName" => "krobbins");
$s1 = new User($validTest);
HomeView::show($s1);
?>
</body>
</html>
