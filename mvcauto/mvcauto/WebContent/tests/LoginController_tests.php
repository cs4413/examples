<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login Controller</title>
</head>
<body>
<h1>Login controller tests</h1>

<?php
include_once("../controllers/LoginController.class.php");
include_once("../models/User.class.php");
include_once("../views/HomeView.class.php");
?>

<h2>It should call the run method for valid input</h2>
<?php 
$_SERVER ["REQUEST_METHOD"] = "POST";
$_POST = array("userName" => "krobbins");
LoginController::run();
?>
</body>
</html>
