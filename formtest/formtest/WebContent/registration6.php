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
$firstName = $lastName = $email = $gender = ""; $lastNameError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = stripInput($_POST["firstName"]);
  $lastName = stripInput($_POST["lastName"]);
  $email = stripInput($_POST["email"]);
  $gender = stripInput($_POST["gender"]);
  $lastNameError = validateLastName($lastName);
} 

function stripInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validateLastName($data) {
	if (strlen($data) <= 1) { 
		$error = "Last name too short";
	} else {
		$error = "";
	}
	return $error;
}
?>
 
<section>
<?php  if (!empty($lastNameError)) {
	    echo "Last name error: $lastNameError";
        }
 ?>
 </section>
<section>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <p>
First name: 
<input type="text" name="firstName" value = "<?php echo $firstName ?>" required>
<br><br>
Last name: 
<input type="text" required name="lastName" 
       value = "<?php echo (empty($lastNameError))?$lastName:''?>">
       <?php echo "$lastNameError"; ?>
   
<br><br>
Email:  
<input type="email" name="email" value = "<?php echo $lastName?>" required>
<br><br>
Gender: 
<input type="radio" name="gender" value="male" 
    <?php echo ($gender =="male")?"checked":'' ?>>Male 
<input type="radio" name="gender" value="female"
    <?php echo ($gender =="female")?"checked":'' ?>>Female
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