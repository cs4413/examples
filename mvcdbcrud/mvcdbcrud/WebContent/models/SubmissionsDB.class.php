<?php
class SubmissionsDB {
	
	public static function addSubmission($submission) {
		// Inserts $submission into the Submissions table and returns submissionId
		$query = "INSERT INTO Submissions (submissionFile, assignmentNumber, submitterId)
		                      VALUES(:submissionFile, :assignmentNumber, :submitterId)";
		try {
			$db = Database::getDB ();
			if (is_null($submission) || $submission->getErrorCount() > 0)
				return $submission;
			$users = UsersDB::getUsersBy('userName', $submission->getSubmitterName());
			if (is_null($users) || empty($users)){
				$submission->setError('submitterName', 'SUBMITTER_NAME_DOES_NOT_EXIST');
				return $submission;
			}
			$statement = $db->prepare ($query);
			$statement->bindValue(":submissionFile", $submission->getSubmission());
			$statement->bindValue(":assignmentNumber", $submission->getAssignmentNumber());
			$statement->bindValue(":submitterId", $users[0]->getUserId());
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("submissionId");
			$submission->setSubmissionId($returnId);
		} catch (Exception $e) { // Not permanent error handling
			$submission->setError('submissionId', 'SUBMISSION_IDENTITY_INVALID');
		}
		return $submission;
	}
	
	public static function getSubmissionRowSetsBy($type = null, $value = null) {
		// Returns the rows of Submissions whose $type field has value $value
		$allowedTypes = array("submissionId", "submitterName", "assignmentNumber");
		$typeAlias = array("submitterName" => "Users.userName");
		$submissionRowSets = array();
		try {
			$db = Database::getDB ();
			$query = "SELECT Submissions.assignmentNumber, Submissions.submissionFile, 
					  Submissions.submitterId, Submissions.submissionId, 
	   		          Users.userName as submitterName
	   		          FROM Submissions LEFT JOIN Users ON Submissions.submitterId = Users.userId";

			if (!is_null($type)) {
				if (!in_array($type, $allowedTypes))
					throw new PDOException("$type not an allowed search criterion for Submissions");
				$typeValue = (isset($typeAlias[$type]))?$typeAlias[$type]:$type; 
			    $query = $query. " WHERE ($typeValue = :$type)";
			    $statement = $db->prepare($query);
			    $statement->bindParam(":$type", $value);
			} else 
				$statement = $db->prepare($query);
			$statement->execute ();
			$submissionRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			
		}
		return $submissionRowSets;
	}
	
	public static function getSubmissionsArray($rowSets) {
		// Return an array of Submission objects extracted from $rowSets
		$submissions = array();

		foreach ($rowSets as $submissionRow ) {
			$submission = new Submission($submissionRow);
			$submission->setSubmissionId($submissionRow['submissionId']);
			array_push ($submissions, $submission);
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
	
	public static function updateSubmission($submission) {
		// Update a submission
		try {
			$db = Database::getDB ();
			if (is_null($submission) || $submission->getErrorCount() > 0)
				return $submission;
			$checkSubmission = SubmissionsDB::getSubmissionsBy('submissionId', $submission->getSubmissionId());
			if (empty($checkSubmission))
				$submission->setError('submissionId', 'SUBMISSION_DOES_NOT_EXIST');
			elseif ($checkSubmission[0]->getSubmitterName() != $submission->getSubmitterName())
			    $submission->setError('submitterName', 'SUBMITTER_NAME_DOES_NOT_MATCH');
			elseif ($checkSubmission[0]->getAssignmentNumber() != $submission->getAssignmentNumber())
			$submission->setError('assignmentNumber', 'SUBMISSION_ASSIGNMENT_NUMBERS_DO_NOT_MATCH');
			if ($submission->getErrorCount() > 0)
				return $submission;
	
			$query = "UPDATE Submissions SET submissionFile = :submissionFile
	    			                 WHERE submissionId = :submissionId";
	
			$statement = $db->prepare ($query);
			$statement->bindValue(":submissionFile", $submission->getSubmissionFile());
			$statement->bindValue(":submissionId", $submission->getSubmissionId());
			$statement->execute ();
			$statement->closeCursor();
		} catch (Exception $e) { // Not permanent error handling
			$submission->setError('submissionId', 'SUBMISSION_COULD_NOT_BE_UPDATED');
		}
		return $submission;
	}
	
}
?>