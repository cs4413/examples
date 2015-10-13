<?php

class DBMaker {
	public static function create($dbName) {
		// Creates a database named $dbName for testing and returns connection
		$db = null;
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . "". ";charset=utf8";
			$username = 'root';
			$password = '';
			$options = array (
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
			);
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
					password           varchar(255) COLLATE utf8_unicode_ci,
				    dateCreated    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
					PRIMARY KEY (userId)
			)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci" );
			$st->execute ();
			
			$st = $db->prepare ("CREATE TABLE Submissions (
			  	             submissionId       int(11) NOT NULL AUTO_INCREMENT,
				             userId             int(11) NOT NULL COLLATE utf8_unicode_ci,
				             assignmentNumber   int COLLATE utf8_unicode_ci,
				             submissionFile     varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
				             dateCreated    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				             PRIMARY KEY (submissionId),
				             FOREIGN KEY (userId) REFERENCES Users(userId)
		              )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;" );
			$st->execute ();
			
			$st = $db->prepare ("DROP TABLE if EXISTS Reviews");
			$st->execute ();
			
			$st = $db->prepare ("CREATE TABLE Reviews (
		  			             reviewId           int(11) NOT NULL AUTO_INCREMENT,
					             submissionId       int(11) NOT NULL,
					             userId             int(11) NOT NULL COLLATE utf8_unicode_ci,
					             score              int NOT NULL COLLATE utf8_unicode_ci,
					             review             varchar (4096) NOT NULL COLLATE utf8_unicode_ci,
					             dateCreated    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
					             PRIMARY KEY (reviewId),
					             FOREIGN KEY (submissionId) REFERENCES Submissions(submissionId),
					             FOREIGN KEY (userId) REFERENCES Users(userId)
			                 )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
					        );
			$st->execute ();
			
			$sql = "INSERT INTO Users (userId, userName, password) VALUES
		                          (:userId, :userName, :password)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':userId' => 1, ':userName' => 'Kay', ':password' => 'xxx'));
			$st->execute (array (':userId' => 2, ':userName' => 'John', ':password' => 'yyy'));
			$st->execute (array (':userId' => 3, ':userName' => 'Alice', ':password' => 'zzz'));
			$st->execute (array (':userId' => 4, ':userName' => 'George', ':password' => 'www'));
			
			$sql = "INSERT INTO Submissions (submissionId, userId, assignmentNumber, submissionFile) 
	                             VALUES (:submissionId, :userId, :assignmentNumber, :submissionFile)";
			$st = $db->prepare ($sql);
			$st->execute (array (':submissionId' => 1, ':userId' => 1, ':assignmentNumber' => '1',
					             ':submissionFile' => 'Kay1.txt'));
			$st->execute (array (':submissionId' => 2, ':userId' => 1, ':assignmentNumber' => '2',
					             ':submissionFile' => 'Kay2.txt'));
			$st->execute (array (':submissionId' => 3, ':userId' => 2, ':assignmentNumber' => '1',
					             ':submissionFile' => 'John1.txt'));
			
			$sql = "INSERT INTO Reviews (reviewId, submissionId, userId, score, review)
	                             VALUES (:reviewId, :submissionId, :userId, :score, :review)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':reviewId' => 1, ':submissionId' => 1, ':userId' => 2, ':score' => 4,
					             ':review' => 'This is a review by John of Kay1.txt'));
			$st->execute (array (':reviewId' => 2, ':submissionId' => 1, ':userId' => 4, ':score' => 3,
				            	':review' => 'This is a review by Alice of Kay1.txt'));
			$st->execute (array (':reviewId' => 3, ':submissionId' => 1, ':userId' => 4, ':score' => 4,
					             ':review' => 'This is a review by George of Kay1.txt'));
			$st->execute (array (':reviewId' => 4, ':submissionId' => 2, ':userId' => 3, ':score' => 4,
					            ':review' => 'This is a review of John of Kay2.txt'));
			$st->execute (array (':reviewId' => 5, ':submissionId' => 1,':userId' => 2, ':score' => 4,
					             ':review' => 'This is my review of Kay1.txt'));
			$st->execute (array (':reviewId' => 6, ':submissionId' => 1, ':userId' => 2, ':score' => 4,
					             ':review' => 'This is my review of Kay1.txt'));
			$st->execute (array (':reviewId' => 7, ':submissionId' => 2,':userId' => 1, ':score' => 4,
					':review' => 'This is my review of Kay2.txt'));
			$st->execute (array (':reviewId' => 8, ':submissionId' => 3, ':userId' => 1, ':score' => 4,
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
			$username = 'root';
			$password = '';
			$options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$db = new PDO ($dbspec, $username, $password, $options);
			$st = $db->prepare ("DROP DATABASE if EXISTS $dbName");
			$st->execute ();
		} catch ( PDOException $e ) {
			echo $e->getMessage (); // not final error handling
		}
	}
}
?>