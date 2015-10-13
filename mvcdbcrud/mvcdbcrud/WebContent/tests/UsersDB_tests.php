<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for UsersDB</title>
</head>
<body>
<h1>UsersDB tests</h1>


<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("./makeDB.php");
?>


<h2>It should get all users from a test database</h2>
<?php
makeDB('ptest'); 
Database::clearDB();
$db = Database::getDB('ptest');
$users = UsersDB::getUsersBy();
$userCount = count($users);
echo "Number of users in db is: $userCount <br>";
foreach ($users as $user) 
	echo "$user <br>";
?>	

<h2>It should allow a user to be added</h2>
<?php 
echo "Number of users in db before added is: ". count(UsersDB::getUsersBy()) ."<br>";
$validTest = array("userName" => "joan", "password" => "123");
$user = new User($validTest);
$userId = UsersDB::addUser($user);
echo "Number of users in db after added is: ". count(UsersDB::getUsersBy()) ."<br>";
echo "User ID of new user is: $userId<br>";
?>

<h2>It should not add an invalid user</h2>
<?php 
echo "Number of users in db before added is: ". count(UsersDB::getUsersBy()) ."<br>";
$invalidUser = new User(array("userName" => "krobbins$"));
$userId = UsersDB::addUser($invalidUser);
echo "Number of users in db after added is: ". count(UsersDB::getUsersBy()) ."<br>";
echo "User ID of new user is: $userId<br>";
?>

<h2>It should not add a duplicate user</h2>
<?php 
echo "Number of users in db before added is: ". count(UsersDB::getUsersBy()) ."<br>";
$duplicateUser = new User(array("userName" => "Kay", "password" => "XXX"));
$userId = UsersDB::addUser($duplicateUser);
echo "Number of users in db after added is: ". count(UsersDB::getUsersBy()) ."<br>";
echo "User ID of new user is: $userId<br>";
?>

<h2>It should get a User by userName</h2>
<?php 
$users = UsersDB::getUsersBy('userName', 'George');
echo "The value of User George is:<br>$users[0]<br>";
?>

<h2>It should get a User by userId</h2>
<?php 
$users = UsersDB::getUsersBy('userId', '3');
echo "The value of User 3 is:<br>$users[0]<br>";
?>

<h2>It should not get a User not in Users</h2>
<?php 
$users = UsersDB::getUsersBy('userName', 'Alfred');
if (empty($users))
	echo "No User Alfred";
else echo "The value of User Alfred is:<br>$users[0]<br>";
?>

<h2>It should not get a User by a field that isn't there</h2>
<?php
$users = UsersDB::getUsersBy('telephone', '21052348234');
if (empty($users))
	echo "No User with this telephone number";
else 
	echo "The value of User with a specified telephone number is:<br>$user<br>";
?>

<h2>It should get a user name by user id</h2>
<?php
$userNames = UsersDB::getUserValuesBy('userName', 'userId', 1);
print_r($userNames);
?>
</body>
</html>