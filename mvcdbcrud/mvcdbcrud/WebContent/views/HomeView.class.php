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
	
	  echo '<h3><a href="/'.$base.'/login">Would you like to login?</a></h3>';  
	  echo '<h3><a href="/'.$base.'/submission/new">Would you like to make a submission</a></h3>'; 
	  echo '<h3><a href="/'.$base.'/submission/showall">Would you like to show all submissions</a></h3>';
	  echo '<h3><a href="/'.$base.'/review/showall">Would you like to show all reviews</a></h3>';
	  echo '<h3><a href="/'.$base.'/review/new">Would you like to review?</a></h3>'; 
	  echo '<h3><a href="/'.$base.'/tests.html">Would you like to run the tests?</a></h3>';  
   }
}
?>