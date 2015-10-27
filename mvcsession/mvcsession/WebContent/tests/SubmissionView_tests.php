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

<h2>It should show a Submission with a header and footer</h2>
<?php 
$validSubmission = array("submitterName" => "krobbins", "assignmentId" => "1",
		           "submissionFile" => "myText.apl");
$s1 = new Submission($validSubmission);
$_SESSION = array('submission' => $s1, 'base' => "mvcsession");

SubmissionView::show();
?>


<h2>It should show a Submission table with a header and a footer</h2>
<?php 
$validSubmission = array("submitterName" => "krobbins", "assignmentId" => "1",
		           "submissionFile" => "myText.apl");

$s1 = new Submission($validSubmission);
$s1 -> setSubmissionId(1);
$submissions = array($s1, $s1);
$_SESSION = array('submissions' => $submissions,
   		            'headerTitle' => "ClassBash Submissions",
		            'footerTitle' => "<h3>The footer goes here</h3>",
		            'base' => "mvcsession");
SubmissionView::showall();
?> 
 
<h2>It should show a Submission table without a header and a footer</h2>
<?php 
$s1 -> setSubmissionId(1);
$submissions = array($s1, $s1);
$_SESSION = array('submissions' => $submissions,
		            'base' => "mvcsession");
SubmissionView::showall();
?>  

<h2>It should allow updating when a valid submission is passed</h2>
<?php 
$validSubmission = array("submitterName" => "krobbins", "assignmentId" => "1",
		           "submissionFile" => "myText.apl");
$s1 = new Submission($validSubmission);
$s1->setSubmissionId(1);
$_SESSION = array('submission' => $s1, 'base' => "mvcsession");
echo $s1;
SubmissionView::showUpdate();
?>
</body>
</html>
