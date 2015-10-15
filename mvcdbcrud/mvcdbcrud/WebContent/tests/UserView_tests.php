<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User View</title>
</head>
<body>
<h1>User view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/User.class.php");
include_once("../views/UserView.class.php");
include_once("../views/MasterView.class.php");
?>

<h2>It should show successfully when user is passed to show</h2>
<?php 
$validTest = array("userName" => "krobbins");
$s1 = new User($validTest);
$_SESSION = array('user' => $s1);
UserView::show();
?>

<h2>It should show all users when the session variable is set</h2>
<?php 
$s1 = new User(array("userName" => "Kay", "password" => "xxx"));
$s1 -> setUserId(1);
$s2 = new User(array("userName" => "John", "password" => "yyy"));
$s2 -> setUserId(2);

$_SESSION['users'] = array($s1, $s2);
$_SESSION['base'] = 'mvcdbdcrud';
$_SESSION['arguments'] = null;
UserView::showall();
?>
</body>
</html>
