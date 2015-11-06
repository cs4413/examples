<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Assignment Controller</title>
</head>
<body>
<h1>Review controller tests</h1>

<?php
include_once("../controllers/AssignmentController.class.php");
include_once("../models/Assignment.class.php");
include_once("../models/AssignmentsDB.class.php");
include_once("../models/Configuration.class.php");
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("../views/AssignmentView.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/AssignmentView.class.php");
include_once("./DBMaker.class.php");
?>

<h2>It should should show a assignment that exists</h2>
<?php
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SESSION = array('base' => 'mvcsession', 'control' => 'assignment',
		'action' =>'show', 'arguments' => 1);
AssignmentController::run();
?>

<h2>It should go to home when no assignment exists</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => 'mvcsession', 'control' => 'assignment',
		             'action' =>'show', 'arguments' => 0);
AssignmentController::run();
?>

<h2>It should display a form for a new assignment</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => 'mvcsession', 'control' => 'assignment',
		             'action' =>'new', 'arguments' => null);
AssignmentController::run();
?>

<h2>It should display a form for an update</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => 'mvcsession', 'control' => 'assignment',
		             'action' =>'update', 'arguments' => 1);
AssignmentController::run();
?>


</body>
</html>
