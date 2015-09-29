<?php
include("../models/Database.class.php");
include("./makeDB.php");
include("../models/User.class.php");
include("../models/UsersDB.class.php");

echo "<h1>Tests for UsersDB</h1>";
$myDb = makeDB('mytest');

echo "<h2>It should create get all users from a test database</h2>";
$users = UsersDB::getAllUsers();
$userCount = count($users);
echo "Number of users in db is: $userCount <br>";
foreach ($users as $user) 
	echo "$user <br>";
	

echo "<h2>It should allow a user to be added</h2>";
echo "Number of users in db before added is: ". count(UsersDB::getAllUsers()) ."<br>";
$validTest = array("userName" => "krobbins", "password" => "123");
$user = new User($validTest);
$userId = UsersDB::addUser($user);
echo "Number of users in db after added is: ". count(UsersDB::getAllUsers()) ."<br>";
echo "User ID of new user is: $userId<br>";


echo "<h2>It should not add an invalid user</h2>";
echo "Number of users in db before added is: ". count(UsersDB::getAllUsers()) ."<br>";
$invalidUser = new User(array("userName" => "krobbins$"));
$userId = UsersDB::addUser($invalidUser);
echo "Number of users in db after added is: ". count(UsersDB::getAllUsers()) ."<br>";
echo "User ID of new user is: $userId<br>";
?>