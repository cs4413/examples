<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for makeDB</title>
</head>
<body>
<h1>makeDB tests</h1>

<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("./DBMaker.class.php");
?>

<h1>Resetting the database</h1>

<h2>It should create the classbashdb</h2>
<?php
$myDb = DBMaker::create('classbashdb');
?>

</body>
</html>