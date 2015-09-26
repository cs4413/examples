<?php
include("../models/Database.class.php");
include("./makeTestDatabase.php");
echo "<h1>Tests for making a test database</h1>";

echo "<h2>It should create a database for a particular name</h2>";
$myDb = makeTestDatabase('testie');
?>