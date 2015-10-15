<?php
class SubmissionsDB {
	
	public static function addSubmission($submission) {
		// Inserts $submission into the Submissions table and returns submissionId
		$query = "INSERT INTO Submissions (submissionFile, assignmentNumber, userId)
		                      VALUES(:submissionFile, :assignmentNumber, :userId)";
		$returnId = 0;
		try {
			$db = Database::getDB ();
			if (is_null($submission) || $submission->getErrorCount() > 0)
				throw new PDOException("Invalid Submission object can't be inserted");
			$users = UsersDB::getUsersBy('userName', $submission->getUserName());
			if (is_null($users) || empty($users))
				throw new PDOException("Submission user name doesn't correspond to a real user");
			$statement = $db->prepare ($query);
			$statement->bindValue(":submissionFile", $submission->getSubmission());
			$statement->bindValue(":assignmentNumber", $submission->getAssignmentNumber());
			$statement->bindValue(":userId", $users[0]->getUserId());
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("submissionId");
		} catch (Exception $e) { // Not permanent error handling
			echo "<p>Error adding submission ".$e->getMessage()."</p>";
		}
		return $returnId;
	}
	
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