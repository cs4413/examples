<?php
class ReviewsDB {
	
	public static function addReview($review) {
		// Inserts the Review object $user into the Users table and returns userId
		$query = "INSERT INTO Reviews (review, score, submissionId, userId)
		                      VALUES(:review, :score, :submissionId, :userId)";
		$returnId = 0;
		try {
			$db = Database::getDB ();
			if (is_null($review) || $review->getErrorCount() > 0)
				throw new PDOException("Invalid Review object can't be inserted");
			$users = UsersDB::getUsersBy('userName', $review->getUserName());
			if (is_null($users) || empty($users))
				throw new PDOException("Review user name doesn't correspond to a real user");
			$statement = $db->prepare ($query);
			$statement->bindValue(":review", $review->getReview());
			$statement->bindValue(":score", $review->getScore());
			$statement->bindValue(":submissionId", $review->getSubmissionId());
			$statement->bindValue(":userId", $users[0]->getUserId());
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("reviewId");
		} catch (Exception $e) { // Not permanent error handling
			echo "<p>Error adding review to Reviews ".$e->getMessage()."</p>";
		}
		return $returnId;
	}
	
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
		} catch (Exception $e) { // Not permanent error handling
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
	
	public static function updateReview($review) {
		$returnId = 0;
		try {
			$db = Database::getDB ();
			if (is_null($review) || $review->getErrorCount() > 0)
				throw new PDOException("Invalid Review object can't be inserted");
	  	    $checkReview = ReviewsDB::getReviewsBy('reviewId', $review->getReviewId());
		    if (empty($checkReview))
		    	throw new PDOException("Review with Id ".$review->getReviewId().
		    			        " does not exist and cannot be updated");
		    elseif ($checkReview[0]->getSubmissionId() != $review->getSubmissionId())
		        throw new PDOException("Review submission Id does not match database");
		    elseif ($checkReview[0]->getUserName() != $review->getUserName())
		    throw new PDOException("Review user name does not match database");
	    	$query = "UPDATE Reviews SET review = :review, score = :score
	    			                 WHERE reviewId = :reviewId";
		
			$statement = $db->prepare ($query);
			$statement->bindValue(":review", $review->getReview());
			$statement->bindValue(":score", $review->getScore());
			$statement->bindValue(":reviewId", $review->getReviewId());
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $checkReview[0]->getReviewId();
		} catch (Exception $e) { // Not permanent error handling
			echo "<p>Error updating review to Reviews ".$e->getMessage()."</p>";
		}
		return $returnId;
	}
}
?>