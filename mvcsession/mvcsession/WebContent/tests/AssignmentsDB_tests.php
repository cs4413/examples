<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for AssignmentsDB</title>
</head>
<body>
<h1>ReviewsDB tests</h1>


<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Assignment.class.php");
include_once("../models/AssignmentsDB.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("./DBMaker.class.php");
?>


<h2>It should get all assignments from a test database</h2>
<?php
DBMaker::create('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest');
$assignments = AssignmentsDB::getAssignmentsBy();
$assignmentCount = count($assignments);
echo "Number of assignments in db is: $assignmentCount <br>";
foreach ($assignments as $assignment) 
	echo "$assignment <br>";
?>

<h2>It should insert a valid assignment in the database</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$beforeCount = count(AssignmentsDB::getAssignmentsBy());
$validTest = array("assignmentOwnerName" => "Kay",
  			"assignmentDescription" => "This was a great presentation"
  	);
$s1 = new Assignment($validTest);
$s1New = AssignmentsDB::addAssignment($s1);
$afterCount = count(AssignmentsDB::getAssignmentsBy());
echo "The new assignment is: $s1New<br>";
echo "Before the database has $beforeCount<br>";
echo "Now the database has $afterCount<br>";
?>

<h2>It should not allow insertion of a duplicate assignment</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$beforeCount = count(AssignmentsDB::getAssignmentsBy());
$duplicateTest = array("reviewerName" => "Alice",
		"assignmentDescription" => "This was a great presentation"
);
$s1 = new Assignment($duplicateTest);
$s1New = AssignmentsDB::addAssignment($s1);
$afterCount = count(AssignmentsDB::getAssignmentsBy());
echo "The errors are: <br>";
print_r($s1New->getErrors());
echo "<br>Before the database has $beforeCount<br>";
echo "Now the database has $afterCount<br>";
?>

<h2>It should all update of a valid assignment</h2>
<?php 
DBMaker::create('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest');
$beforeCount = count(AssignmentsDB::getAssignmentsBy());
$assignments = ReviewsDB::getAssignmentsBy('assignmentId', 1);
$currentAssignment = $assignments[0];
echo "Current review: $currentAssignment<br>";
$parms = $currentAssignment->getParameters();
$parms['assignment'] = 'new assignment text';
$newAssignment = new Assignment($parms);
$newAssignment->setReviewId($currentAssignment->getAssignmentId());
$updatedAssignment = AssignmentsDB::updateAssignment($newAssignment);
echo "Updated assignment: $updatedAssignment<br>";
$afterCount = count(ReviewsDB::getAssignmentsBy());
echo "<br>Count before update = $beforeCount<br>";
echo "Count after = $afterCount<br>";
?>

 <h2>It should get a assignment by assignment name</h2>
<?php
  DBMaker::create('ptest');
  Database::clearDB();
  $db = Database::getDB('ptest');
 
  $assignments = AssignmentsDB::getAssignmentsBy('assignmentOwnerName', 'Alice');
  echo "<br>Number of assignments by Alice is ". count($assignments);
  foreach ($assignments as $assignment)
  	echo "<br>Assignment: $assignment<br>";
   
?>

</body>
</html>