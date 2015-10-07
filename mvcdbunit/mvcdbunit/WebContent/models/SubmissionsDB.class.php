<?php
class SubmissionsDB {
	
	public static function getAllSubmissions() {
       // Return all of the submissions as an array of Submission objects
	   $query = "SELECT Submissions.assignmentNumber, Submissions.submissionFile, 
	                    Users.userName FROM Submissions, Users
	                    LEFT JOIN Submissions ON Submissions.userId = Users.userId";
	   $submissions = array();
	   try {
	      $db = Database::getDB();
	      $statement = $db->prepare($query);
	      $statement->execute();
	      echo "toHereOne<br>";
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
			$submission = new Submission($submissionRow);
			array_push ($submissions, $submission );
		}
		return $submission;
	}

}
?>