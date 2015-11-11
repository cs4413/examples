DROP DATABASE if EXISTS classbashdb;
CREATE DATABASE classbashdb;
USE classbashdb;

DROP TABLE if EXISTS Users;
CREATE TABLE Users (
  userId             int(11) NOT NULL AUTO_INCREMENT,
  userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  password           varchar(255) NOT NULL COLLATE utf8_unicode_ci,
  dateCreated        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS Assignments;
CREATE TABLE Assignments (
  assignmentId           int(11) NOT NULL AUTO_INCREMENT,
  assignmentOwnerId      int(11) NOT NULL,
  assignmentDescription  varchar (4096) COLLATE utf8_unicode_ci,
  assignmentTitle        varchar (255) COLLATE utf8_unicode_ci,
  dateCreated            TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (assignmentId),
  FOREIGN KEY (assignmentOwnerId) REFERENCES Users(userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS Submissions;
CREATE TABLE Submissions (
  submissionId       int(11) NOT NULL AUTO_INCREMENT,
  submitterId        int(11) NOT NULL,
  assignmentId       int(11) NOT NULL,
  submissionFile     varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  dateCreated        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (submissionId),
  FOREIGN KEY (submitterId) REFERENCES Users(userId),
  FOREIGN KEY (assignmentId) REFERENCES Assignments(assignmentId),
  CONSTRAINT sid_anum UNIQUE (submitterId, assignmentId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS Reviews;
CREATE TABLE Reviews (
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
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO Users (userId, userName, password) VALUES 
	   (1, 'Kay', 'xxx');  
INSERT INTO Users (userId, userName,  password) VALUES 
	   (2, 'John', 'yyy');
INSERT INTO Users (userId, userName, password) VALUES 
	   (3, 'Alice', 'xxx');  
INSERT INTO Users (userId, userName,  password) VALUES 
	   (4, 'George', 'yyy');
	   
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (1, 1, 'This is an assignment', 'Assignment 1');
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (2, 1, 'This is another assignment', 'Assignment 2');
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (3, 1, 'This is a third assignment', 'Assignment 3');
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (4, 1, 'This is a fourth assignment', 'Assignment 4');       
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (5, 2, 'This is the fifth assignment', 'Assignment 4');
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (6, 2, 'This is the sixth assignment', 'Assignment 5');
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (7, 3, 'This is the seventh assignment', 'Assignment 7');
INSERT INTO Assignments (assignmentId, assignmentOwnerId, assignmentDescription, assignmentTitle) VALUES
       (8, 4, 'This is the eighth assignment', 'Assignment 8');       

       INSERT INTO Submissions (submissionId, submitterId, assignmentId, submissionFile) VALUES 
	   (1, 1, 1, 'Kay1.txt');  
INSERT INTO Submissions (submissionId, submitterId, assignmentId, submissionFile) VALUES 
	   (2, 1, 2, 'Kay2.txt');
INSERT INTO Submissions (submissionId, submitterId, assignmentId, submissionFile) VALUES 
	   (3, 2, 1, 'John1.txt');
	   
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (1, 1, 2, 4, 'This is a review by John of Kay1.txt');
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (2, 1, 3, 2, 'This is a review by Alice of Kay1.txt'); 
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (3, 1, 4, 4, 'This is a review by George of Kay1.txt');
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (4, 2, 2, 4, 'This is a review of John of Kay2.txt');
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (5, 2, 3, 4, 'This is a review by Alice of Kay2.txt');
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (6, 3, 3, 4, 'This is a review by Alice of John1.txt'); 
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (7, 2, 1, 4, 'This is a review of Kay of Kay2.txt');
INSERT INTO Reviews (reviewId, submissionId, reviewerId, score, review) VALUES 
	   (8, 3, 1, 4, 'This is a review of Kay of John1.txt');
