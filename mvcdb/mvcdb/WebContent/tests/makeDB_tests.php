<?php
include("../models/Database.class.php");
include("./makeDB.php");
echo "<h1>Tests for making a database using prepared statements</h1>";

echo "<h2>It should create a database for a particular name</h2>";
$myDb = makeDB('ptest');
?>