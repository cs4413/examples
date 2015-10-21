<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for SubmissionsDB</title>
</head>
<body>
<h1>SubmissionsDB tests</h1>


<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Submission.class.php");
include_once("../models/SubmissionsDB.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("./DBMaker.class.php");
?>


<h2>It should get all submissions from a test database</h2>
<?php
DBMaker::create('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest');
$submissions = SubmissionsDB::getSubmissionsBy();
$submissionCount = count($submissions);
echo "Number of submissions in db is: $submissionCount <br>";
foreach ($submissions as $submission) 
	echo "$submission <br>";
?>	

<h2>It should insert a valid submission in the database</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$beforeCount = count(SubmissionsDB::getSubmissionsBy());
$validTest = array("submitterName" => "Kay", "assignmentNumber" => "8",
		           "submissionFile" => "V:\test.txt");
$s1 = new Submission($validTest);
echo "<br>In insertion should not have errors $s1<br>";
print_r($s1->getErrors());
$newS1 = SubmissionsDB::addSubmission($s1);
$afterCount = count(SubmissionsDB::getSubmissionsBy());
echo 'The inserted submission Id is:'. $newS1->getSubmissionId().'<br>';
echo "Before the database has $beforeCount";
echo "Now the database has $afterCount";
?>

<h2>It should not allow insertion of a duplicate submission</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$beforeCount = count(SubmissionsDB::getSubmissionsBy());
$duplicateTest =  array("submitterName" => "Kay", "assignmentNumber" => "1",
		           "submissionFile" => "V:\test.txt");
$s1 = new Submission($duplicateTest);
$newS1 = SubmissionsDB::addSubmission($s1);
$afterCount = count(SubmissionsDB::getSubmissionsBy());
echo "The inserted submission errors:";
print_r($newS1->getErrors());
echo "Before the database has $beforeCount";
echo "Now the database has $afterCount";
?>

<h2>It should get a submission by submitter name</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$submissions = SubmissionsDB::getSubmissionsBy('submitterName', 'Kay');
echo "<br>Number of submissions by Kay is ". count($submissions);
foreach ($submissions as $submission)
    echo "<br>Submission: $submission<br>";
?>
</body>
</html>