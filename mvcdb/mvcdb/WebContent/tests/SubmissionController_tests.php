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
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Submission.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/SubmissionView.class.php");
include_once("./makeDB.php");
?>

<h2>It should call the run method for valid input during $POST</h2>
<?php 
$myDb = makeDB('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_POST = array("userName" => "Kay");
SubmissionController::run();
?>

<h2>It should call show the submission page for a $GET request</h2>
<?php 
$_SERVER ["REQUEST_METHOD"] = "GET";
SubmissionController::run();
?>
</body>
</html>
