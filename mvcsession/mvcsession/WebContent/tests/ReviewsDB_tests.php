<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for ReviewsDB</title>
</head>
<body>
<h1>ReviewsDB tests</h1>


<?php
include_once("../models/Configuration.class.php");
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Review.class.php");
include_once("../models/ReviewsDB.class.php");
include_once("../models/Submission.class.php");
include_once("../models/SubmissionsDB.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("./DBMaker.class.php");
?>


<h2>It should get all reviews from a test database</h2>
<?php
DBMaker::create('ptest'); 
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
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$beforeCount = count(ReviewsDB::getReviewsBy());
$validTest = array("reviewerName" => "Kay",
  			"submissionId" => "1",
  			"score" => "5",
  			"review" => "This was a great presentation"
  	);
$s1 = new Review($validTest);
$s1New = ReviewsDB::addReview($s1);
$afterCount = count(ReviewsDB::getReviewsBy());
echo "The new review is: $s1New<br>";
echo "Before the database has $beforeCount<br>";
echo "Now the database has $afterCount<br>";
?>

<h2>It should not allow insertion of a duplicate review</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$beforeCount = count(ReviewsDB::getReviewsBy());
$duplicateTest = array("reviewerName" => "Alice",
		"submissionId" => "1",
		"score" => "5",
		"review" => "This was a great presentation"
);
$s1 = new Review($duplicateTest);
$s1New = ReviewsDB::addReview($s1);
$afterCount = count(ReviewsDB::getReviewsBy());
echo "The errors are: <br>";
print_r($s1New->getErrors());
echo "<br>Before the database has $beforeCount<br>";
echo "Now the database has $afterCount<br>";
?>

<h2>It should all update of a valid review</h2>
<?php 
DBMaker::create('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest');
$beforeCount = count(ReviewsDB::getReviewsBy());
$reviews = ReviewsDB::getReviewsBy('reviewId', 1);
$currentReview = $reviews[0];
echo "Current review: $currentReview<br>";
$parms = $currentReview->getParameters();
$parms['review'] = 'new review text';
$newReview = new Review($parms);
$newReview->setReviewId($currentReview->getReviewId());
$updatedReview = ReviewsDB::updateReview($newReview);
echo "Updated review: $updatedReview<br>";
$afterCount = count(ReviewsDB::getReviewsBy());
echo "<br>Count before update = $beforeCount<br>";
echo "Count after = $afterCount<br>";
?>

 <h2>It should get a review by reviewer name</h2>
<?php
  DBMaker::create('ptest');
  Database::clearDB();
  $db = Database::getDB('ptest');
 
  $reviews = ReviewsDB::getReviewsBy('reviewerName', 'Alice');
  echo "<br>Number of reviews by Alice is ". count($reviews);
  foreach ($reviews as $review)
  	echo "<br>Review: $review<br>";
   
?>

</body>
</html>