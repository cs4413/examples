<?php
class AssignmentsDB {
	
	public static function addAssignment($assignment) {
		// Inserts $assignment into the Assignments table and returns assignmentId
		$query = "INSERT INTO Assignments (assignmentOwnerId, assignmentTitle, assignmentDescription)
		                      VALUES(:assignmentOwnerId, :assignmentTitle, :assignmentDescription)";
		try {
			$db = Database::getDB ();
			if (is_null($assignment) || $assignment->getErrorCount() > 0)
				return $assignment;
			$users = UsersDB::getUsersBy('userName', $assignment->getAssignmentOwnerName());
			if (is_null($users) || empty($users)){
				$assignment->setError('assignmentOwnerName', 'ASSIGNMENT_OWNER_NAME_DOES_NOT_EXIST');
				return $assignment;
			}
			
			$statement = $db->prepare ($query);
			$statement->bindValue(":assignmentTitle", $assignment->getAssignmentTitle());
			$statement->bindValue(":assignmentDescription", $assignment->getAssignmentDescription());
			$statement->bindValue(":assignmentOwnerId", $users[0]->getUserId());
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("assignmentId");
			$assignment->setAssignmentId($returnId);
		} catch (Exception $e) { // Not permanent error handling
			$assignment->setError('assignmentId', 'ASSIGNMENT_IDENTITY_INVALID');
		}
		return $assignment;
	}
	
	public static function getAssignmentRowSetsBy($type = null, $value = null) {
		// Returns the rows of Assignments whose $type field has value $value
		$allowedTypes = array("assignmentId", "assignmentOwnerName", "assignmentTitle", "assignmentDescription");
		$typeAlias = array("assignmentOwnerName" => "Users.userName");
		$assignmentRowSets = array();
		try {
			$db = Database::getDB ();
			$query = "SELECT Assignments.assignmentId, Assignments.assignmentDescription, 
	   		          Assignments.assignmentTitle, Users.userName as assignmentOwnerName
	   		          FROM Assignments LEFT JOIN Users ON Assignments.assignmentOwnerId = Users.userId";

			if (!is_null($type)) {
				if (!in_array($type, $allowedTypes))
					throw new PDOException("$type not an allowed search criterion for Assignments");
				$typeValue = (isset($typeAlias[$type]))?$typeAlias[$type]:$type; 
			    $query = $query. " WHERE ($typeValue = :$type)";
			    $statement = $db->prepare($query);
			    $statement->bindParam(":$type", $value);
			} else 
				$statement = $db->prepare($query);
			$statement->execute ();
			$assignmentRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			
		}
		return $assignmentRowSets;
	}
	
	public static function getAssignmentsArray($rowSets) {
		// Return an array of Assignment objects extracted from $rowSets
		$assignments = array();

		foreach ($rowSets as $assignmentRow ) {
			$assignment = new Assignment($assignmentRow);
			$assignment->setAssignmentId($assignmentRow['assignmentId']);
			array_push ($assignments, $assignment);
		}
		return $assignments;
	}
	
	public static function getAssignmentsBy($type=null, $value=null) {
		// Returns Assignment objects whose $type field has value $value
		$assignmentRows = AssignmentsDB::getAssignmentRowSetsBy($type, $value);
		return AssignmentsDB::getAssignmentsArray($assignmentRows);
	}
	public static function getAssignmentValues($rowSets, $column) {
		// Returns an array of values from $column extracted from $rowSets
		$assignmentValues = array();
		foreach ($rowSets as $assignmentRow )  {
			$submissionValue = $assignmentRow[$column];
			array_push ($assignmentValues, $assignmentValue);
		}
		return $assignmentValues;
	}
	
	public static function getAssignmentValuesBy($column, $type=null, $value=null) {
		// Returns the column of the Assignments whose $type field has value $value
		$assignmentRows = AssignmentDB::getAssignmentRowSetsBy($type, $value);
		return AssignmentsDB::getAssignmentValues($assignmentRows, $column);
	}
	
	public static function updateAssignment($assignment) {
		// Update a submission
		try {
			$db = Database::getDB ();
			if (is_null($assignment) || $assignment->getErrorCount() > 0)
				return $assignment;
			$checkAssignment = AssignmentsDB::getAssignmentsBy('assignmentId', $assignment->getAssignmentId());
			if (empty($checkAssignment))
				$assignment->setError('assignmentId', 'ASSIGNMENT_DOES_NOT_EXIST');
			elseif ($checkAssignment[0]->getAssignmentOwnerName() != $assignment->getAssignmentOwnerName())
			    $assignment->setError('assignmentOwnerName', 'ASSIGNMENT_OWNER_NAME_DOES_NOT_MATCH');
			if ($assignment->getErrorCount() > 0)
				return $assignment;
	
			$query = "UPDATE Assignments SET assignmentDescription = :assignmentDescription,
					    assignmentTitle = :assignmentTitle
	    			    WHERE assignmentId = :assignmentId";
	
			$statement = $db->prepare ($query);
			$statement->bindValue(":assignmentDescription", $assignment->getAssignmentDescription());
			$statement->bindValue(":assignmentTitle", $assignment->getAssignmentTitle());
			$statement->bindValue(":assignmentId", $assignment->getAssignmentId());
			$statement->execute ();
			$statement->closeCursor();
		} catch (Exception $e) { // Not permanent error handling
			$assignment->setError('assignmentId', 'ASSIGNMENT_COULD_NOT_BE_UPDATED');
		}
		return $assignment;
	}
	
}
?>