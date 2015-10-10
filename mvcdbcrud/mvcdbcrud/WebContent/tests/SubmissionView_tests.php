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
include_once("../views/MasterView.class.php");
include_once("../views/SubmissionView.class.php");
?>

<h2>It should show when $submission is null</h2>
<?php 
SubmissionView::show(null);
?>

<h2>It should show a Submission with a header and footer</h2>
<?php 
$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", "tmp_name" => "temp.1"));

$s1 = new Submission($validTest);
SubmissionView::show($s1, "ClassBash Submission Form", "<h3>The footer goes here</h3>");
?>

<h2>It should show a Submission with no header and footer</h2>
<?php 
$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", "tmp_name" => "temp.1"));

$s1 = new Submission($validTest);
SubmissionView::show($s1);
?> 

<h2>It should show a Submission table with a header and a footer</h2>
<?php 
$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", "tmp_name" => "temp.1"));

$s1 = new Submission($validTest);
$s1 -> setSubmissionId(1);
$submissions = array($s1, $s1);
SubmissionView::showall($submissions, "ClassBash Submissions", "<h3>The footer goes here</h3>");
?> 
 
<h2>It should show a Submission table without a header and a footer</h2>
<?php 
$validTest = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", "tmp_name" => "temp.1"));

$s1 = new Submission($validTest);
$s1 -> setSubmissionId(1);
$submissions = array($s1, $s1);
SubmissionView::showall($submissions);
?>  

</body>
</html>
