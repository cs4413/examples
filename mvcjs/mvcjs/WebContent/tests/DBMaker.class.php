<?php

class DBMaker {

	
	public static function create($dbName) {
		// Creates a database named $dbName for testing and returns connection
		$db = null;
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . "". ";charset=utf8";
			$passArray = parse_ini_file(Configuration::getConfigurationPath());
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
				  passwordHash           varchar(255) NOT NULL COLLATE utf8_unicode_ci,
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
			         assignmentCreationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
					 assignmentDueDate      TIMESTAMP NOT NULL,
			         PRIMARY KEY (assignmentId),
			         FOREIGN KEY (assignmentOwnerId) REFERENCES Users(userId)
			         )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
			$st->execute ();
			
			$st = $db->prepare ("CREATE TABLE Submissions (
			         submissionId       int(11) NOT NULL AUTO_INCREMENT,
			         submitterId        int(11) NOT NULL,
			         assignmentId       int(11) NOT NULL,
			         submissionFile     varchar (1024) NOT NULL COLLATE utf8_unicode_ci,
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
				
			$sql = "INSERT INTO Users (userId, userName, passwordHash) VALUES
		                          (:userId, :userName, :passwordHash)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':userId' => 1, ':userName' => 'Kay', 
					             ':passwordHash' => password_hash('xxx1', PASSWORD_DEFAULT)));
			$st->execute (array (':userId' => 2, ':userName' => 'John', 
					             ':passwordHash' => password_hash('xxx2', PASSWORD_DEFAULT)));
			$st->execute (array (':userId' => 3, ':userName' => 'Alice', 
					             ':passwordHash' => password_hash('xxx3', PASSWORD_DEFAULT)));
			$st->execute (array (':userId' => 4, ':userName' => 'George', 
					             ':passwordHash' => password_hash('xxx4', PASSWORD_DEFAULT)));

			$sql = "INSERT INTO Assignments (assignmentId, assignmentOwnerId, 
			          assignmentDescription, assignmentTitle, assignmentDueDate) VALUES
			          (:assignmentId, :assignmentOwnerId, :assignmentDescription, 
					   :assignmentTitle, :assignmentDueDate)";
			$st = $db->prepare ($sql);
			
			$st->execute (array (':assignmentId' => 1 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is an assignment', 
			                     ':assignmentTitle' => 'Assignment 1',	  
			                     ':assignmentDueDate' => '2015-11-14 22:40:19'));
			$st->execute (array (':assignmentId' => 2 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is another assignment', 
			                     ':assignmentTitle' => 'Assignment 2',	  
			                     ':assignmentDueDate' => '2015-11-18 22:30:19'));
			$st->execute (array (':assignmentId' => 3 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is a third assignment', 
			                     ':assignmentTitle' => 'Assignment 3',	  
			                     ':assignmentDueDate' => '2015-12-14 22:40:19'));
			$st->execute (array (':assignmentId' => 4 , ':assignmentOwnerId' => 1, 
			                     ':assignmentDescription' =>  'This is a fourth assignment', 
			                     ':assignmentTitle' => 'Assignment 4',	  
			                     ':assignmentDueDate' => '2016-01-14 22:40:19'));
			$st->execute (array (':assignmentId' => 5 , ':assignmentOwnerId' => 2,
			                     ':assignmentDescription' =>  'This is a fifth assignment',
			                     ':assignmentTitle' => 'Assignment 5',	  
			                     ':assignmentDueDate' => '2015-12-11 14:40:19'));
			$st->execute (array (':assignmentId' => 6 , ':assignmentOwnerId' => 2,
			                     ':assignmentDescription' =>  'This is a sixth assignment',
			                     ':assignmentTitle' => 'Assignment 6',	  
			                     ':assignmentDueDate' => '2015-12-24 22:45:19'));;
			$st->execute (array (':assignmentId' => 7 , ':assignmentOwnerId' => 3,
			                     ':assignmentDescription' =>  'This is a seventh assignment',
			                     ':assignmentTitle' => 'Assignment 7',	  
			                     ':assignmentDueDate' => '2015-11-30 22:40:19'));
			$st->execute (array (':assignmentId' => 8 , ':assignmentOwnerId' => 4,
			                     ':assignmentDescription' =>  'This is the eighth assignment',
			                     ':assignmentTitle' => 'Assignment 8',	  
			                     ':assignmentDueDate' => '2015-11-23 22:40:19'));;
			
			$sql = "INSERT INTO Submissions (submissionId, submitterId, assignmentId, submissionFile) 
	                             VALUES (:submissionId, :submitterId, :assignmentId, :submissionFile)";
			$st = $db->prepare ($sql);
			$sourceFile = dirname(__FILE__).DIRECTORY_SEPARATOR.'test.txt';
			
			$destFile = Configuration::getUploadPath().DIRECTORY_SEPARATOR . $dbName.'_submitter_1_assign_1.txt';
			copy($sourceFile, $destFile);
			$st->execute (array (':submissionId' => 1, ':submitterId' => 1, ':assignmentId' => 1,
					             ':submissionFile' => $destFile));
			
			$destFile = Configuration::getUploadPath().DIRECTORY_SEPARATOR . $dbName.'_submitter_1_assign_2.txt';
			copy($sourceFile, $destFile);
			$st->execute (array (':submissionId' => 2, ':submitterId' => 1, ':assignmentId' => 2,
					':submissionFile' => $destFile));
			
			$destFile = Configuration::getUploadPath().DIRECTORY_SEPARATOR. $dbName.'_submitter_2_assign_1.txt';
			copy($sourceFile, $destFile);
			$st->execute (array (':submissionId' => 3, ':submitterId' => 2, ':assignmentId' => 1,
					':submissionFile' => $destFile));
			
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
			$passArray = parse_ini_file(Configuration::getConfigurationPath());
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
	

}
?>