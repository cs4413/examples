<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Submission View</title>
</head>
<body>
<h1>Submission view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Submission.class.php");
include_once("../models/User.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/SubmissionView.class.php");
?>

<h2>It should show when $submission is null</h2>
<?php 
SubmissionView::show(null);
?>

<h2>It should show when $submission has an input</h2>
<?php 
$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", "tmp_name" => "temp.1"));

$s1 = new Submission($validTest);
SubmissionView::show($s1);
?>

</body>
</html>
