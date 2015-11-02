<?php  
function registerForm($user) {
?>


<form action ="../controllers/registerController.php" method="Post">
<p>User name: <input type="text" name ="userName" 
<?php if (!is_null($user) && !empty($user->getUserName())) {echo 'value = "'. $user->getUserName() .'"';}?>> 
<span class="error"><?php if (!is_null($user)) {echo $user->getError("userName");}?></span></p>

<p>Password: <input id="password" type="password" name ="userPassword" 
<?php if (!is_null($user) && !empty($user->getUserPassword())) {echo 'value = "'. $user->getUserPassword() .'"';}?>> 
<span id="passwordError" class="error"><?php if (!is_null($user)) {echo $user->getError("userPassword");}?></span></p>

<p>Retype password: <input id="retypedPassword" type="password" name ="userPasswordRetyped" onblur="checkPasswordMatch()">
<span id="retypedError" class="error"></span></p>

<p><input type = "submit" name = "submit" value="Submit"></p>
</form>
<?php 
}
?>