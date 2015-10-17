<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Review</title>
</head>
<body>
<h1>Review tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Review.class.php");
?>

<h2>It should create a valid Review object when all input is provided</h2>
<?php 
$validTest = array("reviewerName" => "Kay",
             	   "submissionId" => "R3023",
	           	   "score" => "5",
		           "review" => "This was a great presentation"
		          );
$s1 = new Review($validTest);
echo "The object is: $s1<br>";
$test1 = (is_object($s1))?'':
'Failed:It should create a valid object when valid input is provided<br>';
echo $test1;
$test2 = (empty($s1->getErrors()))?'':
'Failed:It not have errors when valid input is provided<br>';
echo $test2;
?>

<h2>It should extract the parameters that went in</h2>
<?php 
$props = $s1->getParameters();
print_r($props);
?>

<h2>It should have an error when the first name contains invalid characters</h2>
<?php 
$invalidTest = array("reviewerName" => "krobbins$");
$s1 = new Review($invalidTest);
$test2 = (empty($s1->getErrors()))?'':
'Failed:It should have errors when invalid input is provided<br>';
echo $test2;
echo "The error for reviewerName is: ". $s1->getError('reviewerName') ."<br>";
echo "The object is: $s1<br>";
?>
</body>
</html>
