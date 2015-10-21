<?php
class HomeView {
  public static function show() { 
  	  $_SESSION['headertitle'] = "ClassBash Home Page";
	  MasterView::showHeader();
	  MasterView::showNavbar();
	  HomeView::showDetails();
	  $_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
      MasterView::showFooter();
  }

   public static function showDetails() { 
      $base = $_SESSION['base'];
	  echo '<h1>ClassBash: A site for student peer review</h1>';
	  echo '<em>Peer reviewing is really nice.</em>';
	  <div>Icons made by <a href="http://www.flaticon.com/authors/bogdan-rosu" title="Bogdan Rosu">Bogdan Rosu</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a>             is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a></div>
	  echo '<h3><a href="/'.$base.'/login">Would you like to login?</a></h3>';
	  echo '<h3><a href="/'.$base.'/user/new">Would you like to create a new user?</a></h3>';
	  echo '<h3><a href="/'.$base.'/user/showall">Would you like to show all users</a></h3>';
	  echo '<h3><a href="/'.$base.'/submission/new">Would you like to make a new submission</a></h3>'; 
	  echo '<h3><a href="/'.$base.'/review/new">Would you like to do a new review?</a></h3>';
	  echo '<h3><a href="/'.$base.'/submission/showall">Would you like to show all submissions</a></h3>';
	  echo '<h3><a href="/'.$base.'/review/showall">Would you like to show all reviews</a></h3>';
	  echo '<h3><a href="/'.$base.'/tests.html">Would you like to run the tests?</a></h3>';  
   }
}
?>