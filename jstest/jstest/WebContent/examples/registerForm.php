<?php  
function registerForm($user) {
 
   echo '<form action ="/jstest/examples/examples.php" method="Post" >';
   echo '<p>User name: <input type="text" name ="userName"';
   if (!is_null($user) && !empty($user->getUserName())) 
   	  echo 'value = "'. $user->getUserName() .'"';
   echo '>';
   echo '<span class="error">';
   if (!is_null($user)) 
   	   echo $user->getError("userName");
   echo '</span></p>';

   echo '<p>Password: <input id="password" type="password" name ="password"';
   if (!is_null($user) && !empty($user->getUserPassword())) 
   	   echo 'value = "'. $user->getUserPassword() .'"';
   echo '>';
   echo '<span id="passwordError" class="error">';
   if (!is_null($user)) 
   	   echo $user->getError("userPassword");
   echo '</span></p>';

   echo '<p>Retype password: <input id="retypedPassword" type="password" 
   		name ="passwordRetyped" onblur="checkPasswordMatch()">';
   echo '<span id="retypedError" class="error"></span></p>';

   echo '<p><input type = "submit" name = "submit" value="Submit"></p>';
   echo '</form>';
}
?>