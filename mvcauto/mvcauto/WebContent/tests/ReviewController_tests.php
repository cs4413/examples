<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login Controller</title>
</head>
<body>
<h1>Login controller tests</h1>

<?php
include_once("../controllers/ReviewController.class.php");
include_once("../views/ReviewView.class.php");
?>

<h2>It should call the run method</h2>
<?php 
//$_SERVER ["REQUEST_METHOD"] = "POST";
//$_POST = array("firstName" => "Kay");
ReviewController::run();
?>
</body>
</html>
