<?php
class SubmissionsDB {
	
	public static function getSubmissionRowSetsBy($type = null, $value = null) {
		// Returns the rows of Submissions whose $type field has value $value
		$allowedTypes = ["submissionId", "userName", "assignmentNumber"];
		$submissionRowSets = NULL;
		try {
			$db = Database::getDB ();
			$query = "SELECT Submissions.assignmentNumber, Submissions.submissionFile, 
	   		          Submissions.submissionId, Users.userName 
	   		          FROM Submissions LEFT JOIN Users ON Submissions.userId = Users.userId";
			if (!is_null($type)) {
				if (!in_array($type, $allowedTypes))
					throw new PDOException("$type not an allowed search criterion for Submissions");
			    $query = $query. " WHERE ($type = :$type)";
			    $statement = $db->prepare($query);
			    $statement->bindParam(":$type", $value);
			} else 
				$statement = $db->prepare($query);
			$statement->execute ();
			$submissionRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting Submission rows by $type: " . $e->getMessage () . "</p>";
		}
		return $submissionRowSets;
	}
	
	public static function getSubmissionsArray($rowSets) {
		// Return an array of Submission objects extracted from $rowSets
		$submissions = array();
		foreach ($rowSets as $submissionRow ) {
			$submission = new Submission($submissionRow);
			$submission->setSubmissionId($submissionRow['submissionId']);
			array_push ($submissions, $submission );
		}
		return $submissions;
	}
	
	public static function getSubmissionsBy($type=null, $value=null) {
		// Returns Submission objects whose $type field has value $value
		$submissionRows = SubmissionsDB::getSubmissionRowSetsBy($type, $value);
		return SubmissionsDB::getSubmissionsArray($submissionRows);
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
	
	public static function getSubmissionValuesBy($column, $type=null, $value=null) {
		// Returns the column of the Submissions whose $type field has value $value
		$submissionRows = SubmissionDB::getSubmissionRowSetsBy($type, $value);
		return SubmissionsDB::getSubmissionValues($submissionRows, $column);
	}
	
}
?>