<?php
class SubmissionsDB {
	
	public static function getAllSubmissions() {
	   $query = "SELECT * FROM Submissions";
	   $submissions = array();
	   try {
	      $db = Database::getDB();
	      $statement = $db->prepare($query);
	      $statement->execute();
	      $submissions = SubmissionsDB::getSubmissionsArray ($statement->fetchAll(PDO::FETCH_ASSOC));
	      $statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all submissions " . $e->getMessage () . "</p>";
		}
		return $submissions;
	}
	
	public static function getSubmissionsArray($rowSets) {
		// Returns an array of User objects extracted from $rowSets
		$submissions = array();
		foreach ($rowSets as $submissionRow ) {
			$submission = new User($submissionRow);
			array_push ($submissions, $submission );
		}
		return $submission;
	}

}
?>