<?php  
class ReviewView {
	
	public static function show() {
		$_SESSION['headertitle'] = "Review for ClassBash";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		ReviewView::showDetails();
		$_SESSION['footertitle'] ="<h3>The review footer</h3>";
        MasterView::showFooter();
	}
	
	public static function showAll() {
		// Show all review objects on own page
		$_SESSION['headertitle'] = 'List of reviews';
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		ReviewView::showAllDetails();
		$_SESSION['footertitle'] ='<h3>Reviews list footer</h3>';
		MasterView::showFooter();
	}
	
	public static function showAllDetails() {
		// Show a table of review objects with links
		$reviews = (array_key_exists('reviews', $_SESSION))?$_SESSION['reviews']:array();
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo '<div class="container">';
		echo '<h1>List of reviews</h1>';
		echo '<div class="table-responsive">';
		echo '<table class="table table-striped">';
		echo '<thead>';
		echo '<tr><th>Review Id</th><th>Submission Id</th>
			 <th>Reviewer name</th> <th>Review score</th>
			 <th>Show review</td> <th> Update review</th></tr>';
		echo '</thead>';
		echo '<tbody>';
	
		foreach($reviews as $review) {
			echo '<tr>';
			echo '<td>'. $review->getReviewId().'</td>';
			echo '<td><a href="/'.$base.'/submission/show/'.$review->getSubmissionId().'">Submission '. $review->getSubmissionId().'</a></td>';
			echo '<td>'.$review->getReviewerName().'</td>';
			echo '<td>'.$review->getScore().'</td>';
			echo '<td><a href="/'.$base.'/review/show/'.$review->getReviewId().'">Show</a></td>';
			echo '<td><a href="/'.$base.'/review/update/'.$review->getReviewId().'">Update</a></td>';
	        echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
		echo '</div>';
	}
	
	public static function showDetails() {
		// Show the details of a review object without header or footer
		$review = (array_key_exists('review', $_SESSION))?$_SESSION['review']:null;
	    if (!is_null($review)) {
	    	echo '<div class="container">';
	    	echo '<h2>Review: '.$review->getReviewId().'</h2>';
			echo '<p>Submission reviewed: '.$review->getSubmissionId().'</p>';
			echo '<p>Reviewer name: '.$review->getReviewerName().'</p>';
			echo '<p>Score: '. $review->getScore() .'</p>';
			echo '<p>Review:<br> '. $review->getReview() .'</p>';
			echo '</div>';
		}
	}
	
	public static function showNew() {
	   $reviews = (array_key_exists('reviews', $_SESSION))?$_SESSION['reviews']:null;
	   $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
	   $_SESSION['headertitle'] = "Create a new ClassBash review";
	   $_SESSION['styles'] = array('jumbotron.css');
	   MasterView::showHeader();
	   MasterView::showNavbar();
	   
	   echo '<div class="container">';
	   echo '<h1 class ="page-header">'.$_SESSION['headertitle'].'</h1>';
	   echo "</div>";
   
	   echo '<div class="container">';
	   if (is_null($reviews) || empty($reviews) || is_null($reviews[0]))  
	   	   $review = null;
	   else
	       $review = $reviews[0];

	   if (!is_null($review) && $review->getErrors() > 0) {
	      $errors = $review->getErrors();
	      foreach($errors as $key => $value) 
	          echo $value . "<br>";
	   }
	   echo '</div>';
	   
	   echo '<form role="form" method="post" action="/'.$base.'/review/new">';
	   
	   echo  '<div class="form-group">';
       echo  '<label for="reviewerName">Reviewer name:</label>';
	   echo '<input type="text" class="form-control" id = "reviewerName" name="reviewerName"';
	   if (!is_null($review)) 
		   echo 'value = "'. $review->getReviewerName() .'"';
	   echo 'required>';
	   echo '</div>';
	   
	   echo '<div class="form-group">';
	   echo '<label for="submissionId">Submission Id:</label>';
	   echo '<input type="text" class="form-control" name="submissionId"';
	   if (!is_null($review)) 
		   echo 'value = "'. $review->getSubmissionId() .'"';
	   echo 'required>';
	   echo '</div>';
	   
	   echo '<div class="form-group">';
	   echo '<label for="score">Score:</label>';
	   echo '<input class="form-control" type="number" name="score"';
	   if (!is_null($review))
	   	  echo 'value = "'. $review->getScore() .'"';
	   echo 'required min="1" max="5">';
	   echo '</div>';
	   
	   echo '<div class="form-group">';
	   echo '<label for="review">Review:</label>';
       echo '<textarea class="form-control" name="review" placeholder="Write your review here"
					rows="10" cols="80" required>';
       if (!is_null($review))
          echo $review->getReview();
       echo '</textarea>';
       echo '</div>';
       
       echo '<button type="submit" class="btn btn-default">Submit</button>';
	   echo '</form>';
       echo '</div>';
       $_SESSION['footertitle'] = "<h3>Review footer</h3>";
       MasterView::showFooter();
       echo '</div>';
       MasterView::showPageEnd();   
	}
	
	public static function showUpdate() {
		$reviews = (array_key_exists('reviews', $_SESSION))?$_SESSION['reviews']:null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		$_SESSION['headertitle'] = "Update a ClassBash review";
		$_SESSION['styles'] = array();
		MasterView::showHeader();
		MasterView::showNavbar();
		echo '</div>';
		echo '<div class="container">';
		echo '<h1>'.$_SESSION['headertitle'].'</h1>';
		echo "</div>";
		
		echo '<div class="container">';
		if (is_null($reviews) || empty($reviews) || is_null($reviews[0])) {
			echo '<section>Review does not exist</section>';
			return;
		}
		echo '</div>';
		
		echo '<div class ="container">';
		$review = $reviews[0];
		echo '<section>';
		echo '<h3>Review information:</h3>';
		echo 'Reviewer name: '.$review->getReviewerName().'<br>';
		echo 'Submission Id: '.$review->getSubmissionId().'<br>';
		
		if ($review->getErrors() > 0) {
			$errors = $review->getErrors();
			echo '<section><p>Errors:<br>';
			foreach($errors as $key => $value)
				echo $value . "<br>";
			echo '</p></section>';
		}
		echo '</section>';
		echo '</container>';
		
		echo '<div class="container">';
		echo '<form role="form" method="post" action="/'.$base.'/review/update/'.
		                         $review->getReviewId().'">';
		echo '<div class="form-group">';
		echo '<label for="score">Score:</label>';
		echo '<input class="form-control" type="number" name="score"';
		echo 'value = "'. $review->getScore() .'"';
		echo 'required min="1" max="5">';
		echo '</div>';
			
	    echo '<div class="form-group">';
		echo '<label for="review">Review:</label>';
		echo '<textarea class="form-control" name="review" placeholder="Write your review here"
					rows="10" cols="80" required>';
        echo $review->getReview();
        echo '</textarea>';
        echo '</div>';
        
		echo '<button type="submit" class="btn btn-default">Submit</button>';
	    echo '</form>';
        echo '</div>';
        
		$_SESSION['footertitle'] = "The review update footer";
		MasterView::showFooter();
		echo '</div>';
		MasterView::showPageEnd();
	}
}
?>

