-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2017 at 08:05 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

--ADD TO XXAMP ~ lab9 instructions

-- --------------------------------------------------------

CREATE TABLE `User` (
    `userId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `userPassword` VARCHAR(255) NOT NULL
);

CREATE TABLE `Post` (
    `postId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `postTitle` VARCHAR(255) NOT NULL,
    `postContent` VARCHAR(255) NOT NULL,
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
    FOREIGN KEY(`userId`) REFERENCES `User`(`UserId`)
);
-- Dumping data for table `User`
INSERT INTO `User` (`firstName`, `lastName`, `email`, `userPassword`) VALUES
('bobby', 'brown', 'bobby@gmail.com', '360bobby!');

-- Dumping data for table `Post`
INSERT INTO `Post` (`postTitle`, `postContent`, `topic`, `userId`) VALUES
('Bobby''s First Post', 'Hi, I''m Bobby, here is my first post', 'Introductions', 1);



