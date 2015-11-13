<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Assignment View</title>
</head>
<body>
<h1>Assignment view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Assignment.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/AssignmentView.class.php");
$base = 'mvcjs';
?>

<h2>It should call show </h2>
<?php 
$_SESSION = array();
AssignmentView::show();
?>

<h2>It should show successfully when Assignment is passed to show</h2>
<?php 
$input = array("assignmentOwnerName" => "Kay",
		"assignmentId" => 2,
		"assignmentTitle" => "Yep this is a title",
		"assignmentDescription" => "This was a great presentation"
);
$theAssignment = new Assignment($input);
echo "The assignment $theAssignment";
echo "The assignment owner name is ". $theAssignment->getAssignmentOwnerName() ."<br>";
$_SESSION = array('Assignments' => array($theAssignment), 'base' => $base);
AssignmentView::show();
?>

<h2>It should show display the Assignment form with errors at the top if invalid entry</h2>
<?php 
$input = array("AssignmenterName" => "Kay#");
$theAssignment = new Assignment($input);
echo "The assignment $theAssignment";
echo "The assignment owner name is ". $theAssignment->getAssignmentOwnerName() ."<br>";
$_SESSION = array('assignment' => $theAssignment, 'base' => $base);
AssignmentView::show();
?>

<h2>It should allow updating when a valid Assignment is passed</h2>
<?php 
$validTest = array("assignmentOwnerName" => "Kay",
		"assignmentId" => 2,
		"assignmentTitle" => "Yep this is a title",
		"assignmentDescription" => "This was a great presentation"
);
$assignment = new Assignment($validTest);
$assignment->setAssignmentId(1);
echo $assignment;
$_SESSION = array('assignment' => $assignment, 'base' => $base);
AssignmentView::showUpdate();
?>
</body>
</html>
