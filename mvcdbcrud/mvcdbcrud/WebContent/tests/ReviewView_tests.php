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

ReviewView::show(array());
?>

<h2>It should show successfully when review is passed to show</h2>
<?php 
$input = array("firstName" => "Kay");
$theReview = new Review($input);
echo "The review $theReview";
echo "The user name is ". $theReview->getUserName() ."<br>";
$sessionInfo = array('review' => $theReview,
		'base' => "mvcdbcrud");
ReviewView::show($sessionInfo);
?>

<h2>It should show display the review form with errors at the top if invalid entry</h2>
<?php 
$input = array("firstName" => "Kay#");
$theReview = new Review($input);
echo "The review $theReview";
echo "The user name is ". $theReview->getUserName() ."<br>";
$sessionInfo = array('review' => $theReview,
		'base' => "mvcdbcrud");
ReviewView::show($sessionInfo);
?>
</body>
</html>
