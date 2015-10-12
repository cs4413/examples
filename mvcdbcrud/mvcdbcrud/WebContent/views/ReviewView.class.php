<?php  
class ReviewView {
	
	public static function show() {
		$_SESSION['headertitle'] = "Review for ClassBash";
		MasterView::showHeader();
		MasterView::showNavbar();
		ReviewView::showDetails();
		$_SESSION['footertitle'] ="<h3>The footer goes here</h3>";
        MasterView::showFooter();
	}
	
	public static function showAll() {
		// SHow a table of submission objects with links
		if (array_key_exists('headertitle', $_SESSION)) {
			MasterView::showHeader();
			MasterView::showNavbar();
		}
		$reviews = (array_key_exists('reviews', $_SESSION))?$_SESSION['reviews']:array();
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo "<h1>ClassBash review list</h1>";
		echo "<table>";
		echo "<thead>";
		echo "<tr><th>Review Id</th><th>Submission Id</th>
			 <th>Reviewer name</th> <th>Review score</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		print_r($reviews);
		foreach($reviews as $review) {
			echo '<tr>';
			echo '<td><a href="/'.$base.'/review/show/'.$review->getReviewId().'">Review '. $review->getReviewId().'</a></td>';
			echo '<td><a href="/'.$base.'/submission/show/'.$review->getSubmissionId().'">Submission '. $review->getSubmissionId().'</a></td>';
			echo '<td>'.$review->getUserName().'</td>';
			echo '<td>'.$review->getScore().'</td>';
	        echo '</tr>';
		}
		echo "</tbody>";
		echo "</table>";
		if (array_key_exists('footertitle', $_SESSION))
			MasterView::showFooter();
	}
	
	public static function showDetails() {
		$review = (array_key_exists('review', $_SESSION))?$_SESSION['review']:null;
		if (!is_null($review)) {
			echo '<p>Review Id: '.$review->getReviewId().'<p>';
			echo '<p>Submission Id: '.$review->getSubmissionId().'<p>';
			echo '<p>Reviewer name: '.$review->getUserName().'<p>';
			echo '<p>Score: '. $review->getScore() .'</p>';
			echo '<p>Review:<br> '. $review->getReview() .'</p>';
		}
	}
	
	public static function showNew() {
	   $review = (array_key_exists('review', $_SESSION))?$_SESSION['review']:null;
	   $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
	   echo '<h1>ClassBash review form</h1>';
       echo '<section>';
	   if (!is_null($review) && $review->getErrors() > 0) {
	      $errors = $review->getErrors();
	      foreach($errors as $key => $value) 
	          echo $value . "<br>";
	   }
	   echo '</section><form method="post" action="/'.$base.'/review/new">';
	   echo 'Reviewer user name: <input type="text" name="userName"';
	   if (!is_null($review)) 
		   echo 'value = "'. $review->getUserName() .'"';
	   echo 'required> <br>';
			
	   echo '<br> Submission Id: <input type="text" name="submissionId"';
	   if (!is_null($review)) 
		   echo 'value = "'. $review->getSubmissionId() .'"';
	   echo 'required> <br>';
	   echo '<br> Score: <input type="number" name="score"';
	   if (!is_null($review))
	   	  echo 'value = "'. $review->getScore() .'"';
	   echo 'required min="1" max="5"> <br>';
	   echo '<br> Review:<br>';
       echo '<textarea name="review" placeholder="Write your review here"
					rows="10" cols="80" required></textarea><br> <br>';
	   echo '<input type="submit" value="Submit">';
	   echo '</form></section>'; 
	}
}
?>

