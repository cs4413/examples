DROP DATABASE if EXISTS classbash;
CREATE DATABASE classbash;
USE classbash;

DROP TABLE if EXISTS Users;
CREATE TABLE Users (
  userId             int(11) NOT NULL AUTO_INCREMENT,
  userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  password           varchar(255) COLLATE utf8_unicode_ci,
  dateCreated    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS Submissions;
CREATE TABLE Submissions (
  submissionId       int(11) NOT NULL AUTO_INCREMENT,
  userId             int(11) NOT NULL COLLATE utf8_unicode_ci,
  assignmentNumber   int COLLATE utf8_unicode_ci,
  submissionFile     varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  dateCreated    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (submissionId),
  FOREIGN KEY (userId) REFERENCES Users(userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO Users (userId, userName, password) VALUES 
	   (1, 'Kay', 'xxx');  
INSERT INTO Users (userId, userName,  password) VALUES 
	   (2, 'John', 'yyy');
INSERT INTO Users (userId, userName, password) VALUES 
	   (3, 'Alice', 'xxx');  
INSERT INTO Users (userId, userName,  password) VALUES 
	   (4, 'George', 'yyy');
	  
INSERT INTO Submissions (submissionId, userId, assignmentNumber, submissionFile) VALUES 
	   (1, 1, '1', 'Kay1.txt');  
INSERT INTO Submissions (submissionId, userId, assignmentNumber, submissionFile) VALUES 
	   (2, 1, '2', 'Kay2.txt');
INSERT INTO Submissions (submissionId, userId, assignmentNumber, submissionFile) VALUES 
	   (3, 2, '1', 'John1.txt');  
