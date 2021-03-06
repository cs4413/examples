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
$reviews = ReviewsDB::getAllReviews();
$reviewCount = count($reviews);
echo "Number of reviews in db is: $reviewCount <br>";
foreach ($reviews as $review) 
	echo "$review <br>";
?>	


</body>
</html>