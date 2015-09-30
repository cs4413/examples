<?php  
class LoginView {
	public static function show($user) {
		MasterView::showHeader("ClassBash Login Form");
		LoginView::showDetails($user);
		MasterView::showFooter("<h3>The footer goes here</h3>");
	}
	
	public static function showDetails($user) {
?>	
	
	<h1>ClassBash login</h1>
	<form action ="login" method="Post">
	<p>User name: <input type="text" name ="userName" 
	<?php if (!is_null($user)) {echo 'value = "'. $user->getUserName() .'"';}?>> 
	<span class="error">
	   <?php if (!is_null($user)) {echo $user->getError('userName');}?>
	</span></p>
	
	<p>Password: <input type="text" name ="password"> 
	<span class="error">
	   <?php if (!is_null($user)) {echo $user->getError('password');}?>
	</span></p>
	
	<p><input type = "submit" name = "submit" value="Submit"></p>
	</form>
	
	<p>New user?  <a href="register">Sign up here</a></p>
	
	<p>Forget your password?  Well good luck with that.... </p>
<?php 
  }
}
?>