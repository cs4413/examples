<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Registration for ClassBash</title>
</head>
<body>
<h1>ClassBash new user sign-up</h1>
 
<?php
include 'UserData.class.php';
$inputForm = ($_SERVER["REQUEST_METHOD"] == "POST")?$_POST:null;
$user = new UserData($inputForm);
?>
 
<section>
<?php  
$errors = $user->getErrors();
foreach ($errors as $error) {
     echo "$error<br>";
}
?>
 </section>
<section>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <p>
First name: 
<input type="text" name="firstName" value = "<?php echo $user->getFirstName();?>" required>
<br><br>
Last name: 
<input type="text" required name="lastName" 
       value = "<?php echo $user->getLastName();?>">
       <?php echo $user->getError('lastName');?>
   
<br><br>
Email:  
<input type="email" name="email" value = "<?php echo $user->getEmail();?>" required>
<br><br>
Gender: 
<input type="radio" name="gender" value="male" 
    <?php echo ($user->getGender() =="male")?"checked":'' ?>>Male 
<input type="radio" name="gender" value="female"
    <?php echo ($user->getGender())?"checked":'' ?>>Female
<br> <br>
<input type="submit" value="Submit">
</form> 
</section>

<section>
<h2>Responses</h2>
<?php
echo $user->getFirstName();
echo "<br>";
echo $user->getLastName();
echo "<br>";
echo $user->getEmail();
echo "<br>";
echo $user->getGender();
?>
</section>

</body>
</html>