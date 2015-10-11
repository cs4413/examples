<?php  
class ReviewView {
	public static function show($sessionInfo) {
		$sessionInfo['headertitle'] = "Review form for ClassBash";
		MasterView::showHeader($sessionInfo);
		ReviewView::showNew($sessionInfo);
		$sessionInfo['footertitle'] ="<h3>The footer goes here</h3>";
        MasterView::showFooter($sessionInfo);
	}
	
	public static function showNew($sessionInfo) {
	   $review = (array_key_exists('review', $sessionInfo))?$sessionInfo['review']:null;
	   echo '<h1>ClassBash review form</h1>';
       echo '<section>';
	   if (!is_null($review) && $review->getErrors() > 0) {
	      $errors = $review->getErrors();
	      foreach($errors as $key => $value) 
	          echo $value . "<br>";
	   }
	   echo '</section><form method="post" action="review">';
	   echo 'Reviewer user name: <input type="text" name="userName"';
	   if (!is_null($review)) 
		   echo 'value = "'. $review->getUserName() .'"';
	   echo 'required> <br>';
			
	   echo '<br> Submission ID: <input type="text" name="submissionID" required><br>';
	   echo '<br> Score: <input type="number" name="score" required min="1" max="5"> <br>';
	   echo '<br> Review:<br>';
       echo '<textarea name="review" placeholder="Write your review here"
					rows="10" cols="80" required></textarea><br> <br>';
	   echo '<input type="submit" value="Submit">';
	   echo '</form></section>'; 
	}
}
?>

