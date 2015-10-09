<?php
class ReviewsDB {

	public static function getAllReviews() {
       // Return all of the reviews as an array of Review objects
	   $query = "SELECT Reviews.reviewId, Reviews.submissionId, Users.userName,
	   		            Reviews.score, Reviews.review 
	   		             FROM Reviews LEFT JOIN Users ON Reviews.userId = Users.userId ";
	   $reviews = array();
	   try {
	      $db = Database::getDB();
	      $statement = $db->prepare($query);
	      $statement->execute();
	      $reviews = ReviewsDB::getReviewsArray ($statement->fetchAll(PDO::FETCH_ASSOC));
	      $statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all reviews " . $e->getMessage () . "</p>";
		}
		return $reviews;
	}
	
	public static function getReviewsArray($rowSets) {
		// Return an array of Review objects extracted from $rowSets
		$reviews = array();
		foreach ($rowSets as $reviewRow ) {
			$review = new Review($reviewRow);
			array_push ($reviews, $review);
		}
		return $reviews;
	}

}
?>