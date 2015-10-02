DROP DATABASE if EXISTS classbash;
CREATE DATABASE classbash;
USE classbash;

DROP TABLE if EXISTS Users;
CREATE TABLE Users (
  userId             int(11) NOT NULL AUTO_INCREMENT,
  userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  password           varchar(255) COLLATE utf8_unicode_ci,
  PRIMARY KEY (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO Users (userId, userName, password) VALUES 
	   (1, 'Kay', 'xxx');  
INSERT INTO Users (userId, userName,  password) VALUES 
	   (2, 'John', 'yyy');
INSERT INTO Users (userId, userName, password) VALUES 
	   (3, 'Alice', 'xxx');  
INSERT INTO Users (userId, userName,  password) VALUES 
	   (4, 'George', 'yyy');
