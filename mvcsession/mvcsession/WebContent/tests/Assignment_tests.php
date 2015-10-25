<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Assignment</title>
</head>
<body>
<h1>Assignment tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Assignment.class.php");
?>

<h2>It should create a valid Assignment object when all input is provided</h2>
<?php 
$validTest = array("description" => "This is a description of the assignment",
             	   "assignmentOwnerId" => "1");
$s1 = new Assignment($validTest);
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

<h2>It should have an error when the description is missing</h2>
<?php 
$invalidTest = array("assignmentOwnerId" => 1);
$s1 = new Assignment($invalidTest);
$test2 = (empty($s1->getErrors()))?'':
'Failed:It should have errors when invalid input is provided<br>';
echo $test2;
echo "The error for description is: ". $s1->getError('description') ."<br>";
echo "The object is: $s1<br>";
?>
</body>
</html>
