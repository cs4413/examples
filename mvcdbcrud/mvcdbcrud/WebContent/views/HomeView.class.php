<?php
class HomeView {
  public static function show($sessionInfo) { 
  	  $sessionInfo['headertitle'] = "ClassBash Home Page";
	  MasterView::showHeader($sessionInfo);
	  MasterView::showNavbar($sessionInfo);
	  HomeView::showDetails($sessionInfo);
	  $sessionInfo['footertitle'] = "<h3>The footer goes here</h3>";
      MasterView::showFooter($sessionInfo);
  }

   public static function showDetails($sessionInfo) { 
      $base = $sessionInfo['base'];
	  echo '<h1>ClassBash: A site for student peer review</h1>';
	  echo '<em>Peer reviewing is really nice.</em>';
	
	  echo '<h3><a href="/'.$base.'/login">Would you like to login?</a></h3>';  
	  echo '<h3><a href="/'.$base.'/submission/new">Would you like to make a submission</a></h3>'; 
	  echo '<h3><a href="/'.$base.'/review">Would you like to review?</a></h3>'; 
	  echo '<h3><a href="/'.$base.'/tests.html">Would you like to run the tests?</a></h3>';  
   }
}
?>