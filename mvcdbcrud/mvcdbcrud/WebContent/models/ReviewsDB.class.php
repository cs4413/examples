<?php
class ReviewsDB {

	public static function getReviewRowSetsBy($type = null, $value = null) {
		// Returns the rows of Reviews whose $type field has value $value
		$allowedTypes = ["reviewId", "userName", "submissionId", "score", "userId"];
		$reviewRowSets = NULL;
		try {
			$db = Database::getDB ();
			$query = "SELECT Reviews.reviewId, Reviews.submissionId, Reviews.score, Reviews.userId, Users.userName
	   		          FROM Reviews LEFT JOIN Users ON Reviews.userId = Users.userId";
			if (!is_null($type)) {
			    if (!in_array($type, $allowedTypes))
					throw new PDOException("$type not an allowed search criterion for Reviews");
			    $query = $query. " WHERE ($type = :$type)";
			    $statement = $db->prepare($query);
			    $statement->bindParam(":$type", $value);
			} else 
				$statement = $db->prepare($query);
			$statement->execute ();
			$reviewRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting review rows by $type: " . $e->getMessage () . "</p>";
		}
		return $reviewRowSets;
	}

	public static function getReviewsArray($rowSets) {
		// Return an array of Review objects extracted from $rowSets
		$reviews = array();
		foreach ($rowSets as $reviewRow ) {
			$review = new Review($reviewRow);
			$review->setReviewId($reviewRow['reviewId']);
			array_push ($reviews, $review);
		}
		return $reviews;
	}
	
	public static function getReviewsBy($type=null, $value=null) {
		// Returns Review objects whose $type field has value $value
		$reviewRows = ReviewsDB::getReviewRowSetsBy($type, $value);
		return ReviewsDB::getReviewsArray($reviewRows);
	}
	
	public static function getReviewValues($rowSets, $column) {
		// Returns an array of values from $column extracted from $rowSets
		$reviewValues = array();
		foreach ($rowSets as $reviewRow )  {
			$reviewValue = $reviewRow[$column];
			array_push ($reviewValues, $reviewValue);
		}
		return $reviewValues;
	}
	
	public static function getReviewValuesBy($column, $type=null, $value=null) {
		// Returns the $column of Reviews whose $type field has value $value
		$reviewRows = ReviewsDB::getReviewRowSetsBy($type, $value);
		return ReviewsDB::getReviewValues($reviewRows, $column);
	}
}
?>