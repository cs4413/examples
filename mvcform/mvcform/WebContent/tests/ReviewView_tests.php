<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Review View</title>
</head>
<body>
<h1>Review view tests</h1>

<?php
include_once("../views/ReviewView.class.php");
include_once("../models/Review.class.php")
?>

<h2>It should call show </h2>
<?php 

ReviewView::show(null);
?>

<h2>It should show successfully when review is passed to show</h2>
<?php 
$input = array("firstName" => "Kay");
$theReview = new Review($input);
echo "The review $theReview";
echo "The first name is ". $theReview->getFirstName() ."<br>";
ReviewView::show($theReview);
?>
</body>
</html>
