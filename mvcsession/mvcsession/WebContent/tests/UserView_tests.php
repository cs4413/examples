<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User View</title>
</head>
<body>
<h1>User view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Review.class.php");
include_once("../models/Submission.class.php");
include_once("../models/User.class.php");
include_once("../views/UserView.class.php");
include_once("../views/MasterView.class.php");
?>

<h2>It should show successfully when user is passed to show</h2>
<?php 
$validTest = array("userName" => "krobbins", "password" =>"xxx");
$_SESSION = array('user' => new User($validTest), 'base' => 'mvcsession');
$validSubmission = array("submitterName" => "krobbins", "assignmentId" => "1",
		"submissionFile" => "myText.apl");
$_SESSION['userSubmissions'] = array(new Submission($validSubmission));
$input = array("reviewerName" => "krobbins",
		"submissionID" => 2,
		"score" => "5",
		"review" => "This was a great presentation"
);
$_SESSION['userReviews'] = array(new Review($input));
UserView::show();
?>

<h2>It should show all users when the session variable is set</h2>
<?php 
$s1 = new User(array("userName" => "Kay", "password" => "xxx"));
$s1 -> setUserId(1);
$s2 = new User(array("userName" => "John", "password" => "yyy"));
$s2 -> setUserId(2);

$_SESSION = array('users' => array($s1, $s2), 'base' => 'mvcsession', 'arguments' =>null);
UserView::showall();
?>

<h2>It should allow updating when a valid user is passed</h2>
<?php 
$validTest = array("userName" => "Kay", "password" => "xxx");
$user = new User($validTest);
$user->setUserId(1);
echo $user;
$_SESSION = array('users' => array($user), 'base' => "mvcsession");
UserView::showUpdate();
?>
</body>
</html>
