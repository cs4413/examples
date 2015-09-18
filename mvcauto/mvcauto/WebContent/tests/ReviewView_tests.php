<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Review View</title>
</head>
<body>
<h1>Review view tests</h1>

<?php
include_once("../views/ReviewView.class.php");
?>

<h2>It should call show </h2>
<?php 

ReviewView::show($s1);
?>
</body>
</html>
