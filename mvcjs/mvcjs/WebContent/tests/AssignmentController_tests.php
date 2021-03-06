<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Assignment Controller</title>
</head>
<body>
<h1>Assignment controller tests</h1>

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
$base = 'mvcjs';
// Testing the dates
$s = '11/18/2015 13:16';
$t = strtotime($s);
$st = date('Y-m-d G:i:s', $t);
echo "Original $s<br>";
echo "Converted $st<br>";
?>

<h2>It should should show a assignment that exists</h2>
<?php
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SESSION = array('base' => $base, 'control' => 'assignment',
		'action' =>'show', 'arguments' => 1);
AssignmentController::run();
?>

<h2>It should go to home when no assignment exists</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => $base, 'control' => 'assignment',
		             'action' =>'show', 'arguments' => 0);
AssignmentController::run();
?>

<h2>It should display a form for a new assignment</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => $base, 'control' => 'assignment',
		             'action' =>'new', 'arguments' => null);
AssignmentController::run();
?>

<h2>It should display handle a new assignment POST</h2>
<?php 
ob_start();
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "POST";
$_SESSION = array('base' => $base, 'control' => 'assignment',
		             'action' =>'new', 'arguments' => null);
$_POST = array('assignmentOwnerName' => 'George', 
		       'assignmentTitle' => 'A great assignment for all',
		       'assignmentDueDate' => '11/18/2015 13:16',
		       'assignmentDescription' => 'Write your life story');	            
AssignmentController::run();
ob_end_flush();
?>


<h2>It should display a form for an update</h2>
<?php 
ob_start();
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => $base, 'control' => 'assignment',
		             'action' =>'update', 'arguments' => 1);
AssignmentController::run();
ob_end_flush();
?>

<h2>It should produce the assignment lists for a given owner</h2>
<?php 
$myDb = DBMaker::create('ptest');
$_SERVER ["REQUEST_METHOD"] = "GET";
$_SESSION = array('base' => $base, 'control' => 'assignment',
		             'action' =>'instructor', 'arguments' => "Kay");
AssignmentController::run();
?>
</body>
</html>
