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
		$_SESSION['headertitle'] = "Create a new review";
		$_SESSION['styles'] = array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showNewDetails();
		$_SESSION['footertitle'] = "<h3>Review footer</h3>";
		MasterView::showFooter();
	}
	
	public static function showNewDetails() {
	   $review = (array_key_exists('review', $_SESSION))?$_SESSION['review']:null;
	   $base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
	   
	   echo '<div class="container-fluid">';
	   echo '<div class="row">';
	   echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
	   echo '<div class="col-md-6 col-sm-8 col-xs-10">';
	   echo '<h1>'.$_SESSION['headertitle'].'</h1>';

	   echo '<form role="form" method="post" action="/'.$base.'/review/new">';
	   
	   // Error at the top of the form
	   if (!is_null($review) && !empty($review->getError('reviewId'))) {
	     	echo  '<div class="form-group">';
	   	    echo  '<label><span class="label label-danger">';
	   		echo  $review->getError('reviewId');
	   	    echo '</span></label></div>';
	   }
	   	   
	   echo  '<div class="form-group">';
       echo  '<label for="reviewerName">Reviewer name: ';
       echo '<span class="label label-danger">';
   	   if (!is_null($review))
   		  echo $review->getError('reviewName');
   	   echo '</span></label>';
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
	   echo '<label for="review">Review:';
	   echo '<span class="label label-danger">';
	   if (!is_null($review))
	   	  echo $review->getError('review');
	   echo '</span></label>';
       echo '<textarea class="form-control" name="review" id = "review"
       		placeholder="Write your review here" rows="10" required>';
       if (!is_null($review))
          echo $review->getReview();
       echo '</textarea>';
       echo '</div>';
       
       echo '<button type="submit" class="btn btn-default">Submit</button>';
	   echo '</form>';
       echo '</div>';   
       echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
       echo '</div>';
	   echo '</div>';	
	}
	
	public static function showUpdate() {
		$_SESSION['headertitle'] = "Update review";
		$_SESSION['styles'] = array('Jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavbar();
		self::showUpdateDetails();
	}	
		
	public static function showUpdateDetails() {
		$review = (array_key_exists('review', $_SESSION))?$_SESSION['review']:null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		
		echo '<div class="container-fluid">';
		echo '<div class="row">';
		echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
		echo '<div class="col-md-6 col-sm-8 col-xs-10">';
		echo '<h1>'.$_SESSION['headertitle'].'</h1>';
		
		if (is_null($review)) {
			echo '<section>Review does not exist</section></div>';
			return;
		}

		echo '<form role="form" method="post" action="/'.$base.'/review/update/'.
		                         $review->getReviewId().'">';
		// Error at the top of the form
		if (!is_null($review) && !empty($review->getError('reviewId'))) {
			echo  '<div class="form-group">';
			echo  '<label><span class="label label-danger">';
			echo  $review->getError('reviewId');
			echo '</span></label></div>';
		}
		
		echo  '<div class="form-group">';
		echo  '<label for="reviewerName">Reviewer name: ';
		echo '<span class="label label-danger">';
		if (!is_null($review))
			echo $review->getError('reviewName');
		echo '</span></label>';
		echo '<input type="text" class="form-control" id = "reviewerName" name="reviewerName"';
		if (!is_null($review))
			echo 'value = "'. $review->getReviewerName() .'"';
		echo 'required readonly>';
		echo '</div>';
		
		echo '<div class="form-group">';
		echo '<label for="submissionId">Submission Id:</label>';
		echo '<input type="text" class="form-control" id = "submissionId" name="submissionId"';
		if (!is_null($review))
			echo 'value = "'. $review->getSubmissionId() .'"';
		echo 'required readonly>';
		echo '</div>';
		
		echo '<div class="form-group">';
		echo '<label for="score">Score: ';
		echo '<span class="label label-danger">';
   	    if (!is_null($review))
   		    echo $review->getError('score');
   	    echo '</span></label>';
		echo '<input class="form-control" type="number" name="score" id = "score"';
		echo 'value = "'. $review->getScore() .'"';
		echo 'required min="1" max="5">';
		echo '</div>';
			
	    echo '<div class="form-group">';
		echo '<label for="review">Review: ';
		echo '<span class="label label-danger">';
		if (!is_null($review))
   		    echo $review->getError('review');
   	    echo '</span></label>';

		echo '<textarea class="form-control" name="review" id="review" 
				placeholder="Write your review here" rows="10" cols="80" required>';
        echo $review->getReview();
        echo '</textarea>';
        echo '</div>';
        
		echo '<button type="submit" class="btn btn-default">Submit</button>';
	    echo '</form>';
        echo '</div>';   
        echo '<div class="col-md-3 col-sm-2 col-xs-1"></div>';
        echo '</div>';
		echo '</div>';	
	}
}
?>

