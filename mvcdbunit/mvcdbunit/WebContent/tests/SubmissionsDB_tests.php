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
echo "to here";
$submissions = SubmissionsDB::getAllSubmissions();
$submissionCount = count($submissions);
echo "Number of submissions in db is: $submissionCount <br>";
foreach ($submissions as $submission) 
	echo "$submission <br>";
?>	


</body>
</html>