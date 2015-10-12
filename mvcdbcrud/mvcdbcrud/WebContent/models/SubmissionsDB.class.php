<?php
class SubmissionsDB {
	
	public static function getAllSubmissions() {
       // Return all of the submissions as an array of Submission objects
	   $query = "SELECT Submissions.assignmentNumber, Submissions.submissionFile, 
	   		            Submissions.submissionId, Users.userName 
	   		            FROM Submissions LEFT JOIN Users ON Submissions.userId = Users.userId ";
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
	

	
// 	public static function getUsersBy($type, $value) {
// 		// Returns a User object whose $type field has value $value
// 		$userRows = UsersDB::getUserRowSetsBy($type, $value, '*');
// 		return UsersDB::getUsersArray($userRows);
// 	}
	
// 	public static function getUserValuesBy($type, $value, $column) {
// 		// Returns the userId of the user whose $type field has value $value
// 		$userRows = UsersDB::getUserRowSetsBy($type, $value, $column);
// 		return UsersDB::getUserValues($userRows, $column);
// 	}
	
// 	public static function getUserRowSetsBy($type, $value, $column) {
// 		// Returns the rows of Users whose $type field has value $value
// 		$allowedTypes = ["userId", "userName"];
// 		$allowedColumns = ["userId", "userName", "*"];
// 		$userRowSets = NULL;
// 		try {
// 			if (!in_array($type, $allowedTypes))
// 				throw new PDOException("$type not an allowed search criterion for User");
// 			elseif (!in_array($column, $allowedColumns))
// 			throw new PDOException("$column not a column of User");
// 			$query = "SELECT $column FROM Users WHERE ($type = :$type)";
// 			$db = Database::getDB ();
// 			$statement = $db->prepare($query);
// 			$statement->bindParam(":$type", $value);
// 			$statement->execute ();
// 			$userRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
// 			$statement->closeCursor ();
// 		} catch ( PDOException $e ) { // Not permanent error handling
// 			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
// 		}
// 		return $userRowSets;
// 	}
	
	public static function getSubmissionsArray($rowSets) {
		// Return an array of User objects extracted from $rowSets
		$submissions = array();
		foreach ($rowSets as $submissionRow ) {
			$submission = new Submission($submissionRow);
			$submission->setSubmissionId($submissionRow['submissionId']);
			array_push ($submissions, $submission );
		}
		return $submissions;
	}	

}
?>