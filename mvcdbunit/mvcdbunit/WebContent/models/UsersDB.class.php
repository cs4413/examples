<?php
class UsersDB {
	
	public static function addUser($user) {
		// Inserts the User object $user into the Users table and returns userId
		$query = "INSERT INTO Users (userName, password)
		                      VALUES(:userName, :password)";
		$returnId = 0;
		try {
			if (is_null($user) || $user->getErrorCount() > 0)
				throw new PDOException("Invalid User object can't be inserted");
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":userName", $user->getUserName());
			$statement->bindValue(":password", $user->getPassword());	
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("userId");
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error adding user to Users ".$e->getMessage()."</p>";
		}
		return $returnId;
	}

	public static function getAllUsers() {
	   $query = "SELECT * FROM Users";
	   $users = array();
	   try {
	      $db = Database::getDB();
	      $statement = $db->prepare($query);
	      $statement->execute();
	      $users = UsersDB::getUsersArray ($statement->fetchAll(PDO::FETCH_ASSOC));
	      $statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all users " . $e->getMessage () . "</p>";
		}
		return $users;
	}
	
// 	public static function getUserBy($type, $value) {
// 		// Returns a User object whose $type field has value $value
// 		$allowed = ["userId", "userName"];
// 		$user = NULL;
// 		try {
// 			if (!in_array($type, $allowed))
// 				throw new PDOException("$type not an allowed search criterion for User");
// 			$query = "SELECT * FROM Users WHERE ($type = :$type)";
// 			$db = Database::getDB ();
// 			$statement = $db->prepare($query);
// 			$statement->bindParam(":$type", $value);
// 			$statement->execute ();
// 			$userRows = $statement->fetch(PDO::FETCH_ASSOC);
// 			if (!empty($userRows))
// 				$user = new User($userRows);
// 			$statement->closeCursor ();
// 		} catch ( PDOException $e ) { // Not permanent error handling
// 			echo "<p>Error getting user by $type: " . $e->getMessage () . "</p>";
// 		}
// 		return $user;
// 	}

	public static function getUsersBy($type, $value) {
		// Returns a User object whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value, '*');
		return UsersDB::getUsersArray($userRows);
	}
	
	public static function getUserValuesBy($type, $value, $column) {
		// Returns the userId of the user whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value, $column);
		return UsersDB::getUserValues($userRows, $column);
	}
	
	public static function getUserRowSetsBy($type, $value, $column) {
		// Returns the rows of Users whose $type field has value $value
		$allowedTypes = ["userId", "userName"];
		$allowedColumns = ["userId", "userName", "*"];
		$userRowSets = NULL;
		try {
			if (!in_array($type, $allowedTypes))
				throw new PDOException("$type not an allowed search criterion for User");
			elseif (!in_array($column, $allowedColumns))
			    throw new PDOException("$column not a column of User");
			$query = "SELECT $column FROM Users WHERE ($type = :$type)";
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":$type", $value);
			$statement->execute ();
			$userRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
		}
		return $userRowSets;
	}
	
	
	public static function getUsersArray($rowSets) {
		// Returns an array of User objects extracted from $rowSets
		$users = array();
		foreach ($rowSets as $userRow ) {
			$user = new User($userRow);
			array_push ($users, $user );
		}
		return $users;
	}
	
	public static function getUserValues($rowSets, $column) {
		// Returns an array of values from $column extracted from $rowSets
		$userValues = array();
		print_r($rowSets);
		foreach ($rowSets as $userRow )  {
			$userValue = $userRow[$column];
			array_push ($userValues, $userValue);
		}
		return $userValues;
	}
}
?>