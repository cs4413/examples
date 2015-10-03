<?php
function makeDB($dbName) {
	// Creates a database named $dbName for testing and returns connection
	$db = Database::getDB('');
	try {
		$st = $db->prepare("DROP DATABASE if EXISTS $dbName");
		$st->execute();
		$st = $db->prepare("CREATE DATABASE $dbName");
		$st->execute();
		$st = $db->prepare("USE $dbName");
		$st->execute();
		$st = $db->prepare("DROP TABLE if EXISTS Users");
		$st->execute();
		$st = $db->prepare(
			"CREATE TABLE Users (
					userId             int(11) NOT NULL AUTO_INCREMENT,
					userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
					password           varchar(255) COLLATE utf8_unicode_ci,
					PRIMARY KEY (userId)
			)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci"
		);
		$st->execute();
		
		$st = $db->prepare( 
		             "CREATE TABLE Submissions (
			  	             submissionId       int(11) NOT NULL AUTO_INCREMENT,
				             userName           varchar (255) NOT NULL COLLATE utf8_unicode_ci,
				             assignmentNumber   int COLLATE utf8_unicode_ci,
				             submissionFile     varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
				             submissionDateCreated    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				             PRIMARY KEY (submissionId)
		              )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
		 );
		$st->execute();
		
		$sql = "INSERT INTO Users (userId, userName, password) VALUES
		                          (:userId, :userName, :password)";
		$st = $db->prepare($sql);
		$st->execute(array(':userId' => 1, ':userName' => 'Kay', ':password' => 'xxx'));
	    $st->execute(array(':userId' => 2, ':userName' => 'John', ':password' => 'yyy'));
	    $st->execute(array(':userId' => 3, ':userName' => 'Alice', ':password' => 'zzz'));
	    $st->execute(array(':userId' => 4, ':userName' => 'George', ':password' => 'www'));
		
	    $sql = "INSERT INTO Submissions (submissionId, userName, assignmentNumber, submissionFile) 
	                             VALUES (:submissionId, :userName, :assignmentNumber, :submissionFile)";
		$st = $db->prepare($sql);
		$st->execute(array(':submissionId' => 1, ':userName' => 'Kay', 
		                   ':assignmentNumber' => '1', ':submissionFile' =>'Kay1.txt'));
		$st->execute(array(':submissionId' => 2, ':userName' => 'Kay', 
		                   ':assignmentNumber' => '2', ':submissionFile' =>'Kay2.txt'));
		$st->execute(array(':submissionId' => 3, ':userName' => 'John', 
		                   ':assignmentNumber' => '1', ':submissionFile' =>'John1.txt'));
	     
	} catch ( PDOException $e ) {
		echo $e->getMessage ();  // not final error handling
	}
	 
	return $db;
}
?>