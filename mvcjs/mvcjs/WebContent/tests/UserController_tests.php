<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User Controller</title>
</head>
<body>
<h1>User controller tests</h1>

<?php
include_once("../controllers/UserController.class.php");
include_once("../models/Configuration.class.php");
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Review.class.php");
include_once("../models/ReviewsDB.class.php");
include_once("../models/Submission.class.php");
include_once("../models/SubmissionsDB.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/SubmissionView.class.php");
include_once("../views/UserView.class.php");
include_once("./DBMaker.class.php");
?>

<h2>It should should show a user that exists</h2>
<?php 
DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SESSION = array('base' => 'mvcsession', 'control' => 'user', 
	                      'action' =>'show', 'arguments' => 1);
UserController::run();
?>

<h2>It should go to home when no user exists</h2>
<?php 
DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => 'mvcsession', 'control' => 'user',
		             'action' =>'show', 'arguments' => 0);
UserController::run();
?>

<h2>It should allow update</h2>
<?php 
$db = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SESSION = array('base' => 'mvcsession', 'control' => 'user',
		             'action' =>'update', 'arguments' => 1);
$_POST = array("userName" => 'Kay1', 'password' => 'xxx');
print_r($_POST);
UserController::run();
$users = UsersDB::getUsersBy('userId', '1')
?>

<?php ob_end_flush();  ?>
</body>
</html>
