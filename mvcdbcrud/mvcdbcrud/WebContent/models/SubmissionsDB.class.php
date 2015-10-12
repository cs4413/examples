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
		
	public static function getSubmissionsBy($type, $value) {
		// Returns a Submission object whose $type field has value $value
		$submissionRows = SubmissionsDB::getSubmissionRowSetsBy($type, $value, '*');
		return SubmissionsDB::getSubmissionsArray($submissionRows);
	}
	
	public static function getUserValuesBy($type, $value, $column) {
		// Returns the column of the Submissions whose $type field has value $value
		$submissionRows = SubmissionDB::getSubmissionRowSetsBy($type, $value, $column);
		return SubmissionsDB::getSubmissionValues($submissionRows, $column);
	}
	
	public static function getSubmissionRowSetsBy($type, $value, $column) {
		// Returns the rows of Submissions whose $type field has value $value
		$allowedTypes = ["submissionId", "userName", "assignmentNumber"];
		$allowedColumns = ["submissionId", "userName", "assignmentNumber", "*"];
		$submissionRowSets = NULL;
		try {
			if (!in_array($type, $allowedTypes))
				throw new PDOException("$type not an allowed search criterion for Submission");
			elseif (!in_array($column, $allowedColumns))
			throw new PDOException("$column not a column of Submission");
			$query = "SELECT $column FROM Submissions WHERE ($type = :$type)";
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":$type", $value);
			$statement->execute ();
			$submissionRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting Submission rows by $type: " . $e->getMessage () . "</p>";
		}
		return $submissionRowSets;
	}
	
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
	
	public static function getSubmissionValues($rowSets, $column) {
		// Returns an array of values from $column extracted from $rowSets
		$submissionValues = array();
		foreach ($rowSets as $submissionRow )  {
			$submissionValue = $submissionRow[$column];
			array_push ($submissionValues, $submissionValue);
		}
		return $submissionValues;
	}

}
?>