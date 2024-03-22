CREATE DATABASE DDL360;
go

USE DDL360;
go

DROP TABLE IF EXISTS customer;

CREATE TABLE User (
    userId INT IDENTITY;
    firstName       VARCHAR(40),
    lastName        VARCHAR(40),
    email           VARCHAR(50),
    userPassword    VARCHAR(30),
    PRIMARY KEY (userId)
);


CREATE TABLE Post (
    postId INT IDENTITY;
    postTitle       VARCHAR(50),
    userId          VARCHAR(40),
    postContent     VARCHAR(80),
    topic           VARCHAR(50),
    PRIMARY KEY (postId),
    FOREIGN KEY (userId) references User(userId)
        ON UPDATE CASCADE ON DELETE NO ACTION
);

