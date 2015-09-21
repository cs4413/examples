<?php
class ReviewView {
	public static function show($review) {
		?>
     <!DOCTYPE html>
     <html>
     <head>
     <meta charset="ISO-8859-1">
     <title>Review form for ClassBash</title>
     </head>
     <body>
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
			Reviewer first name: <input type="text" name="firstName" 
			<?php if (!is_null($review)) 
			      {echo 'value = "'. $review->getFirstName() .'"';}?>
			required> <br>
			<br> Reviewer last name: <input type="text" name="lastName" required>
			<br>
			<br> Review submission ID: <input type="text" name="submissionID"
					required> <br>
			<br> Score: <input type="number" name="score" required min="1"
					max="5"> <br>
			<br> Review:<br>
			<textarea name="review" placeholder="Write your review here"
					rows="10" cols="80" required></textarea>
			<br> <br> <input type="submit" value="Submit">	
		</form>
	</section>

</body>
</html>
<?php 
}
}
?>