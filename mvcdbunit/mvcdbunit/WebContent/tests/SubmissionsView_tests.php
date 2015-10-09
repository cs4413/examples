<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Submissions View</title>
</head>
<body>
<h1>Submission view tests</h1>

<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Submission.class.php");
include_once("../models/SubmissionsDB.class.php");
include_once("../models/User.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/SubmissionView.class.php");
include_once("../views/SubmissionsView.class.php");
include_once("./makeDB.php");
?>

<h2>It should show the submissions</h2>
<?php 
makeDB('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$submissions = SubmissionsDB::getAllSubmissions();
SubmissionsView::show($submissions);
?>


</body>
</html>
