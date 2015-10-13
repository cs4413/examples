<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Review View</title>
</head>
<body>
<h1>Review view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Review.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/ReviewView.class.php");
?>

<h2>It should call show </h2>
<?php 
$_SESSION = array();
ReviewView::show();
?>

<h2>It should show successfully when review is passed to show</h2>
<?php 
$input = array("userName" => "Kay",
		"submissionID" => 2,
		"score" => "5",
		"review" => "This was a great presentation"
);
$theReview = new Review($input);
echo "The review $theReview";
echo "The user name is ". $theReview->getUserName() ."<br>";
$_SESSION = array('review' => $theReview, 'base' => "mvcdbcrud");
ReviewView::show();
?>

<h2>It should show display the review form with errors at the top if invalid entry</h2>
<?php 
$input = array("firstName" => "Kay#");
$theReview = new Review($input);
echo "The review $theReview";
echo "The user name is ". $theReview->getUserName() ."<br>";
$_SESSION = array('review' => $theReview, 'base' => "mvcdbcrud");
ReviewView::show();
?>

<h2>It should allow updating when a valid review is passed</h2>
<?php 
$validTest = array("userName" => "Kay",
		"submissionId" => 2,
		"score" => "5",
		"review" => "This was a great presentation"
);
$review = new Review($validTest);
$review->setReviewId(1);
echo $review;
$_SESSION = array('review' => $review, 'base' => "mvcdbcrud");
ReviewView::showUpdate();
?>
</body>
</html>
