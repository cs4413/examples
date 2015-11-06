<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Information View</title>
</head>
<body>
<h1>Home view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../views/InformationView.class.php");
include_once("../views/MasterView.class.php");
?>

<h2>It should call show without crashing</h2>
<?php 
$_SESSION = array("base" => "mvcsession");
InformationView::show();
?>

?>
</body>
</html>
