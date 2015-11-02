<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Review Controller</title>
</head>
<body>
<h1>Review controller tests</h1>

<?php
include_once("../controllers/ReviewController.class.php");
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
include_once("../views/ReviewView.class.php");
include_once("./DBMaker.class.php");
?>


<h2>It should should show a review that exists</h2>
<?php
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SESSION = array('base' => 'mvcsession', 'control' => 'review',
		'action' =>'show', 'arguments' => 1);
ReviewController::run();
?>

<h2>It should go to home when no review exists</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => 'mvcsession', 'control' => 'review',
		             'action' =>'show', 'arguments' => 0);
ReviewController::run();
?>

<h2>It should display a form for a new review</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => 'mvcsession', 'control' => 'review',
		             'action' =>'new', 'arguments' => null);
ReviewController::run();
?>

<h2>It should display a form for an update</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => 'mvcsession', 'control' => 'review',
		             'action' =>'update', 'arguments' => 1);
ReviewController::run();
?>


</body>
</html>
