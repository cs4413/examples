<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Registration for ClassBash</title>
</head>
<body>
<h1>ClassBash new user sign-up</h1>
 
<?php
// define variables and set to empty values
$firstName = $lastName = $email = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $firstName = $_POST["firstName"];
   $lastName = $_POST["lastName"];
   $email = $_POST["email"];
   $gender = $_POST["gender"];
}

?>
<section>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <p>
First name: 
<input type="text" name="firstName" required>
<br><br>
Last name: 
<input type="text" name="lastName" required>
<br><br>
Email:  
<input type="email" name="email" required>
<br><br>
Gender: 
<input type="radio" name="gender" value="male" checked>Male 
<input type="radio" name="gender" value="female">Female
<br> <br>
<input type="submit" value="Submit">
</form> 
</section>

<section>
<h2>Responses</h2>
<?php
echo $firstName;
echo "<br>";
echo $lastName;
echo "<br>";
echo $email;
echo "<br>";
echo $gender;
?>
</section>

</body>
</html>