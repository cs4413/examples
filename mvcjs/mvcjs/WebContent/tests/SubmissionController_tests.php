<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Submission Controller</title>
</head>
<body>
<h1>Submission controller tests</h1>

<?php
include_once("../controllers/SubmissionController.class.php");
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
$base = 'mvcjs';
?>

<h2>It should should a new submission form input during $POST with incomplete information</h2>
<?php 
DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SESSION = array('base' => $base, 'control' => 'submission', 
	                      'action' =>'new', 'arguments' => null);
$_POST = array("submitterName" => "Kay");
SubmissionController::run();
?>

<h2>It should call show a new submission form for a $GET request</h2>
<?php 
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => $base, 'control' => 'submission',
		             'action' =>'new', 'arguments' => null);
SubmissionController::run();
?>
</body>
</html>
