<?php
class HomeView {
  public static function show($session_info) { 
  	  $session_info['headertitle'] = "ClassBash Home Page";
	  MasterView::showHeader($session_info);
	  MasterView::showNavbar($session_info);
	  HomeView::showDetails($session_info);
	  $session_info['footertitle'] = "<h3>The footer goes here</h3>";
      MasterView::showFooter($session_info);
  }

   public static function showDetails($session_info) { 
      $base = $session_info['base'];
	  echo '<h1>ClassBash: A site for student peer review</h1>';
	  echo '<em>Peer reviewing is really nice.</em>';
	
	  echo '<h3><a href="/'.$base.'/login">Would you like to login?</a></h3>';  
	  echo '<h3><a href="/'.$base.'/submission/new">Would you like to make a submission</a></h3>'; 
	  echo '<h3><a href="/'.$base.'/review">Would you like to review?</a></h3>'; 
	  echo '<h3><a href="/'.$base.'/tests.html">Would you like to run the tests?</a></h3>';  
   }
}
?>