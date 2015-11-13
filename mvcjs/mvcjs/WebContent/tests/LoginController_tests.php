<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login Controller</title>
</head>
<body>
<h1>Login controller tests</h1>

<?php
include_once("../controllers/LoginController.class.php");
include_once("../models/Configuration.class.php");
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/LoginView.class.php");
include_once("../views/MasterView.class.php");
include_once("./DBMaker.class.php");
$base = 'mvcjs';
?>

<h2>It should use password hashes</h2>
<?php 
$passwordHashes = array(password_hash('xxx1', PASSWORD_DEFAULT), 
		                password_hash('xxx2', PASSWORD_DEFAULT), 
		                password_hash('xxx3', PASSWORD_DEFAULT), 
		                password_hash('xxx4', PASSWORD_DEFAULT));

echo "Password hashes:<br>";
print_r($passwordHashes);
?>

<h2>It should call the run method for valid input during $POST</h2>
<?php 
ob_start();
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SERVER["REQUEST_URI"] = "/$base/login";
$_POST = array("userName" => "Kay", "password" => "xxx1");
$_SESSION = array('base' => $base, 'login' => '', 
		          'action' => '', 'arguments' => null);
LoginController::run();
ob_end_flush();
?>

<h2>It should have an error when user doesn't provide a password</h2>
<?php 
ob_start();
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_POST = array("userName" => "Kay");
$_SESSION = array('base' =>$base);
LoginController::run();
ob_end_flush();
?>

<h2>It should have an error when the user isn't in the database</h2>
<?php 
ob_start();
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_POST = array("userName" => "krobbins", "password" => "xyz");
$_SESSION = array('base' => $base);
LoginController::run();
ob_end_flush();
?>

<h2>It should have an error when the password doesn't match</h2>
<?php 
ob_start();
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_POST = array("userName" => "krobbins", "password" => "xyz");
$_SESSION = array('base' => $base);
LoginController::run();
ob_end_flush();
?>


<h2>It should call show the login page for a $GET request</h2>
<?php 
ob_start();
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base'=> $base);
LoginController::run();
ob_start();
?>
</body>
</html>

