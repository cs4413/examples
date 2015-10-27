<?php

class DBMaker {
	public static $configPath = null;
	
	
	public static function create($dbName) {
		// Creates a database named $dbName for testing and returns connection
		$db = null;
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . "". ";charset=utf8";
			self::setConfigurationPath(null); //Make sure path is set
			$passArray = parse_ini_file(self::$configPath);
			$username = $passArray["username"];
			$password = $passArray["password"];
			$options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );
			$db = new PDO ( $dbspec, $username, $password, $options );
			$st = $db->prepare ( "DROP DATABASE if EXISTS $dbName" );
			$st->execute ();
			$st = $db->prepare ( "CREATE DATABASE $dbName" );
			$st->execute ();
			$st = $db->prepare ( "USE $dbName" );
			$st->execute ();
			$st = $db->prepare ( "DROP TABLE if EXISTS Users" );
			$st->execute ();
			$st = $db->prepare ( "CREATE TABLE Users (
  userId             int(11) NOT NULL AUTO_INCREMENT,
  userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  password           varchar(255) NOT NULL COLLATE utf8_unicode_ci,
  dateCreated        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
			$st->execute ();
			
			$st = $db->prepare ( "DROP TABLE if EXISTS Assignments" );
			$st->execute ();
			$st = $db->prepare ("CREATE TABLE Assignments (
			         assignmentId           int(11) NOT NULL AUTO_INCREMENT,
			         assignmentOwnerId      int(11) NOT NULL,
			         assignmentDescription  varchar (4096) COLLATE utf8_unicode_ci,
			         assignmentTitle        varchar (255) COLLATE utf8_unicode_ci,
			         dateCreated            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			         PRIMARY KEY (assignmentId),
			         FOREIGN KEY (assignmentOwnerId) REFERENCES Users(userId)
			         )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
			$st->execute ();
			
			$st = $db->prepare ("CREATE TABLE Submissions (
			         submissionId       int(11) NOT NULL AUTO_INCREMENT,
			         submitterId        int(11) NOT NULL,
			         assignmentId       int(11) NOT NULL,
			         submissionFile     varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
			         dateCreated        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			         PRIMARY KEY (submissionId),
			         FOREIGN KEY (submitterId) REFERENCES Users(userId),
			         FOREIGN KEY (assignmentId) REFERENCES Assignments(assignmentId),
			         CONSTRAINT sid_anum UNIQUE (submitterId, assignmentId)
			         )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;" );
			$st->execute ();
			
			$st = $db->prepare ("DROP TABLE if EXISTS Reviews");
			$st->execute ();
			
			$st = $db->prepare (
				 "CREATE TABLE Reviews (
			         reviewId           int(11) NOT NULL AUTO_INCREMENT,
			         submissionId       int(11) NOT NULL,
			         reviewerId         int(11) NOT NULL,
			         score              int NOT NULL COLLATE utf8_unicode_ci,
			         review             varchar (4096) NOT NULL COLLATE utf8_unicode_ci,
			         dateCreated        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			         PRIMARY KEY (reviewId),
			         FOREIGN KEY (submissionId) REFERENCES Submissions(submissionId),
			         FOREIGN KEY (reviewerId) REFERENCES Users(userId),
			         CONSTRAINT rid_subid UNIQUE (reviewerId, submissionId)
			         )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
			$st->execute ();
				
			$sql = "INSERT INTO Users (userId, userName, password) VALUES
		                          (:userId, :userName, :password)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':userId' => 1, ':userName' => 'Kay', ':password' => 'xxx'));
			$st->execute (array (':userId' => 2, ':userName' => 'John', ':password' => 'yyy'));
			$st->execute (array (':userId' => 3, ':userName' => 'Alice', ':password' => 'zzz'));
			$st->execute (array (':userId' => 4, ':userName' => 'George', ':password' => 'www'));
			
			$sql = "INSERT INTO Assignments (assignmentId, assignmentOwnerId, 
			          assignmentDescription, assignmentTitle) VALUES
			          (:assignmentId, :assignmentOwnerId, :assignmentDescription, :assignmentTitle)";
			$st = $db->prepare ($sql);
			
			$st->execute (array (':assignmentId' => 1 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is an assignment', 
			                     ':assignmentTitle' => 'Assignment 1'));
			$st->execute (array (':assignmentId' => 2 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is another assignment', 
			                     ':assignmentTitle' => 'Assignment 2'));
			$st->execute (array (':assignmentId' => 3 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is a third assignment', 
			                     ':assignmentTitle' => 'Assignment 3'));
			$st->execute (array (':assignmentId' => 4 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is a fourth assignment', 
			                     ':assignmentTitle' => 'Assignment 4'));			                     
			 
			$sql = "INSERT INTO Submissions (submissionId, submitterId, assignmentId, submissionFile) 
	                             VALUES (:submissionId, :submitterId, :assignmentId, :submissionFile)";
			$st = $db->prepare ($sql);
			$st->execute (array (':submissionId' => 1, ':submitterId' => 1, ':assignmentId' => 1,
					             ':submissionFile' => 'Kay1.txt'));
			$st->execute (array (':submissionId' => 2, ':submitterId' => 1, ':assignmentId' => 2,
					             ':submissionFile' => 'Kay2.txt'));
			$st->execute (array (':submissionId' => 3, ':submitterId' => 2, ':assignmentId' => 1,
					             ':submissionFile' => 'John1.txt'));
			
			$sql = "INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review)
	                             VALUES (:reviewId, :submissionId, :reviewerId, :score, :review)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':reviewId' => 1, ':submissionId' => 1, ':reviewerId' => 2, ':score' => 4,
					             ':review' => 'This is a review by John of Kay1.txt'));
			$st->execute (array (':reviewId' => 2, ':submissionId' => 1, ':reviewerId' => 3, ':score' => 3,
				            	':review' => 'This is a review by Alice of Kay1.txt'));
			$st->execute (array (':reviewId' => 3, ':submissionId' => 1, ':reviewerId' => 4, ':score' => 4,
					             ':review' => 'This is a review by George of Kay1.txt'));
			$st->execute (array (':reviewId' => 4, ':submissionId' => 2, ':reviewerId' => 2, ':score' => 4,
					            ':review' => 'This is a review of John of Kay2.txt'));
			$st->execute (array (':reviewId' => 5, ':submissionId' => 2,':reviewerId' => 3, ':score' => 4,
					             ':review' => 'This is a review by Alice of Kay2.txt'));
			$st->execute (array (':reviewId' => 6, ':submissionId' => 3, ':reviewerId' => 3, ':score' => 4,
					             ':review' => 'This is a review by Alice of John1.txt'));
			$st->execute (array (':reviewId' => 7, ':submissionId' => 2,':reviewerId' => 1, ':score' => 4,
					':review' => 'This is my review of Kay2.txt'));
			$st->execute (array (':reviewId' => 8, ':submissionId' => 3, ':reviewerId' => 1, ':score' => 4,
					':review' => 'This is my review of John1.txt'));
				
		} catch ( PDOException $e ) {
			echo $e->getMessage (); // not final error handling
		}
		
		return $db;
	}
	public static function delete($dbName) {
		// Delete a database named $dbName
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . $dbName . ";charset=utf8";
			self::setConfigurationPath(null); //Make sure path is set
			$passArray = parse_ini_file(self::$configPath);
			$username = $passArray["username"];
			$password = $passArray["password"];
			$options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$db = new PDO ($dbspec, $username, $password, $options);
			$st = $db->prepare ("DROP DATABASE if EXISTS $dbName");
			$st->execute ();
		} catch ( PDOException $e ) {
			echo $e->getMessage (); // not final error handling
		}
	}
	
	public static function setConfigurationPath($path = null) {
		if (!is_null($path))
			self::$configPath = $path;
		elseif (self::$configPath == null)
			self::$configPath = dirname(__FILE__).DIRECTORY_SEPARATOR."..".
			DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR.
			".." . DIRECTORY_SEPARATOR . "myConfig.ini";
	}
}
?>