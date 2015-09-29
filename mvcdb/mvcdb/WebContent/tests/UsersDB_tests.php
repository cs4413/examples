<?php
include("../models/Database.class.php");
include("./makeDB.php");
include("../models/User.class.php");
include("../models/UsersDB.class.php");

echo "<h1>Tests for UsersDB</h1>";

echo "<h2>It should create get all users from a test database</h2>";

$myDb = makeDB('mytest');

$users = UsersDB::getAll();
$userCount = count($users);
echo "Number of users in db is: $userCount <br>";

foreach ($users as $user) 
	echo "$user <br>";
?>