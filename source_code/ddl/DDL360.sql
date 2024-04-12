-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2017 at 08:05 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

-- ADD TO XXAMP ~ lab9 instructions

-- --------------------------------------------------------

DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Post;
DROP TABLE IF EXISTS User;

CREATE TABLE `User` (
    `userId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `userPassword` VARCHAR(255) NOT NULL,
    `username` VARCHAR(50) NOT NULL,
    `bio` VARCHAR(255),
    `pfp` blob NOT NULL,
    `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user' 
);

CREATE TABLE `Post` (
    `postId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `postTitle` VARCHAR(255) NOT NULL,
    `postContent` VARCHAR(255) NOT NULL,
    `postDate` DATE NOT NULL,
    `topic` VARCHAR(255) NOT NULL,
    `userId` INT,
    FOREIGN KEY (`userId`) REFERENCES `User`(`userId`)
);

CREATE TABLE `Comments` (
    `commentId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `commentBody` VARCHAR(255) NOT NULL,
    `postId` INT,
    `userId` INT,
    FOREIGN KEY(`postId`) REFERENCES `Post`(`postId`),
    FOREIGN KEY(`userId`) REFERENCES `User`(`userId`)
);

INSERT INTO `User` (`firstName`, `lastName`, `email`, `userPassword`, `username`, `bio`, `pfp`, `role` ) VALUES
('bobby', 'brown', 'bobby@gmail.com', 'd97b5330ab04e7956d867eb4312b8509', 'bobby123', '', '','admin');
INSERT INTO `User` (`firstName`, `lastName`, `email`, `userPassword`, `username`, `bio`, `pfp`, `role`) VALUES
('james', 'jackson', 'james@gmail.com', '2832889661389d61958a42f77ac5618b', 'officialjames', '', '','user');

INSERT INTO `Post` (`postTitle`, `postContent`, `postDate`, `topic`, `userId`) VALUES
('Bobby''s First Post', 'Hi, I''m Bobby, here is my first post', '2022-04-10','Introductions', 1);
INSERT INTO `Post` (`postTitle`, `postContent`, `postDate`, `topic`, `userId`) VALUES
('First time in Kelowna!', 'I''m James and I''m new to UBCO! Anyone have any suggestions for things to do in Kelowna?', '2024-09-02','Kelowna', 2);




