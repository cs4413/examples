<?php  
class ReviewView {
	public static function show($review) {
		MasterView::showHeader("Review form for ClassBash");
		ReviewView::showDetails($review);
		MasterView::showFooter("<h3>The footer goes here</h3>");
	}
	
	public static function showDetails($review) {
?>	
	 <h1>ClassBash review form</h1>
     
	 <section>
	    <section>
	         <?php
	         if (!is_null($review) && $review->getErrors() > 0) {
	             $errors = $review->getErrors();
	             foreach($errors as $key => $value) 
	             	echo $value . "<br>";
	         }
	         ?>
	    </section>
		<form method="post" action="review">
			Reviewer user name: <input type="text" name="userName" 
			<?php if (!is_null($review)) 
			      {echo 'value = "'. $review->getUserName() .'"';}?>
			required
			> <br>
			
			<br> Submission ID: <input type="text" name="submissionID"
					required> <br>
			<br> Score: <input type="number" name="score" required min="1"
					max="5"> <br>
			<br> Review:<br>
			<textarea name="review" placeholder="Write your review here"
					rows="10" cols="80" required></textarea>
			<br> <br> <input type="submit" value="Submit">	
		</form>
	</section>
<?php 
	}
}
?>

