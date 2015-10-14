<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for ReviewsDB</title>
</head>
<body>
<h1>ReviewsDB tests</h1>


<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Review.class.php");
include_once("../models/ReviewsDB.class.php");
include_once("../models/Submission.class.php");
include_once("../models/SubmissionsDB.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("./makeDB.php");
?>


<h2>It should get all reviews from a test database</h2>
<?php
makeDB('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest');
$reviews = ReviewsDB::getReviewsBy();
$reviewCount = count($reviews);
echo "Number of reviews in db is: $reviewCount <br>";
foreach ($reviews as $review) 
	echo "$review <br>";
?>

<h2>It should insert a valid review in the database</h2>
<?php 
makeDB('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$beforeCount = count(ReviewsDB::getReviewsBy());
$validTest = array("userName" => "Kay",
  			"submissionId" => "1",
  			"score" => "5",
  			"review" => "This was a great presentation"
  	);
$s1 = new Review($validTest);
$reviewId = ReviewsDB::addReview($s1);
$afterCount = count(ReviewsDB::getReviewsBy());
echo "The inserted review Id is: $reviewId";
echo "Before the database has $beforeCount";
echo "Now the database has $afterCount";
?>

<h2>It should not allow insertion of a duplicate review</h2>
<?php 
makeDB('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$beforeCount = count(ReviewsDB::getReviewsBy());
$duplicateTest = array("userName" => "Alice",
		"submissionId" => "1",
		"score" => "5",
		"review" => "This was a great presentation"
);
$s1 = new Review($duplicateTest);
$reviewId = ReviewsDB::addReview($s1);
$afterCount = count(ReviewsDB::getReviewsBy());
echo "The inserted review Id is: $reviewId";
echo "Before the database has $beforeCount";
echo "Now the database has $afterCount";
?>

<h2>It should all update of a valid review</h2>
<?php 
makeDB('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
$beforeCount = count(ReviewsDB::getReviewsBy());
$reviews = ReviewsDB::getReviewsBy('reviewId', 1);
$currentReview = $reviews[0];
echo "Current review: $currentReview<br>";
$parms = $currentReview->getParameters();
$parms['review'] = 'new review text';
$newReview = new Review($parms);
$newReview->setReviewId($currentReview->getReviewId());
echo "new review: $newReview<br>";
$newId = ReviewsDB::updateReview($newReview);
echo "New id: $newId<br>";
$afterCount = count(ReviewsDB::getReviewsBy());
echo "Count before update = $beforeCount, count after = $afterCount<br>";
?>


</body>
</html>