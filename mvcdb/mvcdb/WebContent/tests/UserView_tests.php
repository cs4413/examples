<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User View</title>
</head>
<body>
<h1>User view tests</h1>

<?php
include_once("../views/UserView.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/User.class.php");
?>

<h2>It should show successfully when user is passed to show</h2>
<?php 
$validTest = array("userName" => "krobbins");
$s1 = new User($validTest);
UserView::show($s1);
?>
</body>
</html>
