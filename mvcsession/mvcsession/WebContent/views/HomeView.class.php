<?php
class HomeView {
  public static function show() { 
  	  $_SESSION['headertitle'] = "ClassBash Home Page";
  	  $_SESSION['styles'] = array('jumbotron.css');
	  MasterView::showHeader();
	  MasterView::showNavbar();
	  HomeView::showDetails();
	  $_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
      MasterView::showHomeFooter();
      MasterView::showPageEnd();
  }

   public static function showDetails() { 
      $base = $_SESSION['base'];
      echo '<div class="jumbotron">';
      echo '<div class="container">';
      echo '<h1>ClassBash</h1>';
      echo '<p>Hone your critical thinking skills by critiquing, analyzing, discussing ....<br>
      not just listening ... </p>';
      echo '<p><a class="btn btn-primary btn-lg" href="/'.$base.'/information/show" role="button">Join the party! &raquo;</a></p>';
      echo '</div>';
      echo '</div>';
      
      echo '<div class="container">';
      echo '<div class="row">';
      echo '<div class="col-md-3">';
      echo '<h2>Assign</h2>';
      echo '<p><img src = "/'.$base.'/images/document6.png"></p>';
      echo '<p><a class="btn btn-default" href="/'.$base.'/assignment/new" role="button">Do it now &raquo;</a></p>';
      echo '</div>';
      echo '<div class="col-md-3">';
      echo '<h2>Submit</h2>';
      echo '<p><img src = "/'.$base.'/images/checkbox6.png"> </p>';
      echo '<p><a class="btn btn-default" href="/'.$base.'/submission/new" role="button">Do it now &raquo;</a></p>';
      echo '</div>';
      echo '<div class="col-md-3">';
      echo '<h2>Review</h2>';
      echo '<p><img src = "/'.$base.'/images/social16.png"></p>';
      echo '<p><a class="btn btn-default" href="/'.$base.'/review/new"  role="button">Do it now &raquo;</a></p>';
      echo '</div>';
      echo '<div class="col-md-3">';
      echo '<h2>Report</h2>';
      echo '<p><img src = "/'.$base.'/images/layers.png"></p>';
      echo '<p><a class="btn btn-default" href="/'.$base.'/report/new"  role="button">See it now &raquo;</a></p>';
      echo '</div>';
      echo '</div>';
      echo '<hr>';
	  echo '<h1>ClassBash: A site for student peer review</h1>';
	  echo '<em>Peer reviewing is really nice.</em>';
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