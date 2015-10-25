<?php
class InformationView {
  public static function show() { 
  	  $_SESSION['headertitle'] = "ClassBash Overview ";
  	  $_SESSION['styles'] = array('jumbotron.css');
	  MasterView::showHeader();
	  MasterView::showNavbar();
	  HomeView::showDetails();
	  $_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
      MasterView::showHomeFooter();
      MasterView::showPageEnd();
  }

   public static function showInformation() { 
      $base = $_SESSION['base'];
      echo '<div class="container">';
      echo '<h1>How ClassBash works</h1>';
      echo '<p>Hone your critical thinking skills by critiquing, analyzing, discussing ....<br>
      not just listening ... </p>';
      
      
      echo '<div class="container">';
      echo '<div class="row">';
      echo '<h2>Assign</h2>';
      echo '<p><img src = "/'.$base.'/images/document6.png"></p>';
      echo '<p>Here is information on creating an assignment</p>';
      echo '</div>';
      echo '<div class="row">';
      echo '<h2>Submit</h2>';
      echo '<p><img src = "/'.$base.'/images/checkbox6.png"> </p>';
      echo '<p>Here is information on submitting an assignment.</p>';
      echo '</div>';
      echo '<div class="row">';
      echo '<h2>Review</h2>';
      echo '<p><img src = "/'.$base.'/images/social16.png"></p>';
      echo '<p>Here is information on submitting a review.</p>';
      echo '</div>';
      echo '<div class="row">';
      echo '<h2>Report</h2>';
      echo '<p><img src = "/'.$base.'/images/layers.png"></p>';
      echo '<p>Here is information on the reports.</p>';
      echo '</div>';
      echo '</div>';
   }
}
?>