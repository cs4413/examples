<?php
class HomeView {
  public static function show($user) {  
	  MasterView::showHeader("ClassBash Home Page");
	  HomeView::showDetails($user);
      MasterView::showFooter("<h3>The footer goes here</h3>");
  }

   public static function showDetails($user) {  
?>
	<nav><?php if (!is_null($user)) echo "Hello " . $user->getUserName(). "<br>";?></nav>
	<h1>ClassBash: A site for student peer review</h1>
	<em>Peer reviewing is really nice.</em>
	
	<h3><a href="login">Would you like to login?</a></h3>  
	
	<h3><a href="submission">Would you like to make a submission</a></h3>  
	
	<h3><a href="review">Would you like to review?</a></h3> 
	
	<h3><a href="tests.html">Would you like to run the tests?</a></h3>  
<?php
  }
}
?>