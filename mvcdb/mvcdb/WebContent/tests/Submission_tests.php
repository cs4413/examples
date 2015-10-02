<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Submission</title>
</head>
<body>
<h1>User tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Submission.class.php");
include_once("../models/User.class.php");
?>

<h2>It should create a valid Submission object when all input is provided</h2>
<?php 
$validTest = array("submissionName" => "krobbins");
$s1 = new Submission($validTest);
echo "The object is: $s1<br>";
$test1 = (is_object($s1))?'':
'Failed:It should create a valid object when valid input is provided<br>';
echo $test1;
$test2 = (empty($s1->getErrors()))?'':
'Failed:It not have errors when valid input is provided<br>';
echo $test2;
?>
</body>
</html>
