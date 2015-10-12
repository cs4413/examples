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
	
	public static function getReviewsBy($type, $value) {
		// Return all of the reviews as an array of Review objects
		$query = "SELECT Reviews.reviewId, Reviews.submissionId, Users.userName,
	   		            Reviews.score, Reviews.review
	   		             FROM Reviews LEFT JOIN Users ON Reviews.userId = Users.userId ";
		$allowedTypes = ["reviewId", "userName", "submissionId", "score"];
		$reviews = array();
		try {
			if (!in_array($type, $allowedTypes))
				throw new PDOException("$type not an allowed search criterion for Review");
			$db = Database::getDB();
			if (!is_null($value)) {
				$query = "$query WHERE ($type = :$type)";
			     $statement = $db->prepare($query);
			    $statement->bindParam(":$type", $value);
	     	} else 
			    $statement = $db->prepare($query);
		
			$statement->execute();
			$reviews = ReviewsDB::getReviewsArray ($statement->fetchAll(PDO::FETCH_ASSOC));
			$statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all reviews " . $e->getMessage () . "</p>";
		}
		return $reviews;
	}
	
// 	public static function getReviewsBy($type, $value) {
// 		// Returns Review objects whose $type field has value $value
// 		$reviewRows = ReviewsDB::getReviewRowSetsBy($type, $value, '*');
// 		return ReviewsDB::getReviewsArray($reviewRows);
// 	}
	
	public static function getReviewValuesBy($type, $value, $column) {
		// Returns the $column of Reviews whose $type field has value $value
		$reviewRows = ReviewsDB::getReviewRowSetsBy($type, $value, $column);
		return ReviewsDB::getReviewValues($reviewRows, $column);
	}
	
	public static function getReviewRowSetsBy($type, $value, $column) {
		// Returns the rows of Reviews whose $type field has value $value
		$allowedTypes = ["reviewId", "userName", "submissionId", "score"];
		$allowedColumns = ["reviewId", "userName", "submissionId", "score", "*"];
		$reviewRowSets = NULL;
		try {
			if (!in_array($type, $allowedTypes))
				throw new PDOException("$type not an allowed search criterion for User");
			elseif (!in_array($column, $allowedColumns))
			throw new PDOException("$column not a column of Reviews");
			$query = "SELECT $column FROM Reviews WHERE ($type = :$type)";
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":$type", $value);
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
	
	public static function getReviewValues($rowSets, $column) {
		// Returns an array of values from $column extracted from $rowSets
		$reviewValues = array();
		print_r($rowSets);
		foreach ($rowSets as $reviewRow )  {
			$reviewValue = $reviewRow[$column];
			array_push ($reviewValues, $reviewValue);
		}
		return $reviewValues;
	}

}
?>