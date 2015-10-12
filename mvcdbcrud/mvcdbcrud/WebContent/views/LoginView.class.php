<?php  
class LoginView {
	public static function show($sessionInfo) {
		$sessionInfo['headertitle'] = "ClassBash Login Form";
		MasterView::showHeader($sessionInfo);
		LoginView::showDetails($sessionInfo);
		$sessionInfo['footertitle'] = "<h3>The footer goes here</h3>";
		MasterView::showFooter($sessionInfo);
	}
	
	public static function showDetails($sessionInfo) {
	 // Show the details of the form
	   $user = (array_key_exists('user', $sessionInfo))?$sessionInfo['user']:null;
	   $base = (array_key_exists('base', $sessionInfo))?$sessionInfo['base']:"";
	   echo '<h1>ClassBash login</h1>';
	   echo '<form action ="login" method="Post">';
	   echo '<p>User name: <input type="text" name ="userName"';
	   if (!is_null($user)) 
	   	  echo 'value = "'. $user->getUserName() .'"';
	   echo '><span class="error">';
	   if (!is_null($user))
	      echo $user->getError('userName');
	   echo '</span></p>';
	
	  echo '<p>Password: <input type="text" name ="password"><span class="error">';
	  if (!is_null($user)) 
	  	  echo $user->getError('password');
	  echo '</span></p>';
	  echo '<p><input type = "submit" name = "submit" value="Submit"></p></form>';
	
	  echo '<p>New user?  <a href="register">Sign up here</a></p>';
	  echo '<p>Forget your password?  Well good luck with that.... </p>';
  }
}
?>