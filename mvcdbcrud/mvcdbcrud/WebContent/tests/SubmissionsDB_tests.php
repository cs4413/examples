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
include_once("./makeDB.php");
?>


<h2>It should get all submissions from a test database</h2>
<?php
makeDB('ptest'); 
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
makeDB('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$beforeCount = count(SubmissionsDB::getSubmissionsBy());
$validTest = array("userName" => "Kay", "assignmentNumber" => "5",
		           "submissionFile" => array("name" => "V:\test.txt", 
		           		                     "tmp_name" => "temp.1"));
$s1 = new Submission($validTest);
echo $s1;
print_r($s1->getErrors());
$submissionId = SubmissionsDB::addSubmission($s1);
$afterCount = count(SubmissionsDB::getSubmissionsBy());
echo "The inserted submission Id is: $submissionId";
echo "Before the database has $beforeCount";
echo "Now the database has $afterCount";
?>

<h2>It should not allow insertion of a duplicate submission</h2>
<?php 
makeDB('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$beforeCount = count(SubmissionsDB::getSubmissionsBy());
$duplicateTest =  array("userName" => "Kay", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "V:\test.txt", 
		           		                     "tmp_name" => "temp.1"));
$s1 = new Submission($duplicateTest);
$submissionId = SubmissionsDB::addSubmission($s1);
$afterCount = count(SubmissionsDB::getSubmissionsBy());
echo "The inserted submission Id is: $submissionId";
echo "Before the database has $beforeCount";
echo "Now the database has $afterCount";
?>


</body>
</html>