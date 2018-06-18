-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2018 at 11:52 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmark_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comicrequest`
--

CREATE TABLE `comicrequest` (
  `comic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `issue_no` int(11) NOT NULL,
  `era` enum('Silver Age','Golden Age','Post-Crisis','Rebirth','Flashpoint','New 52','MARVEL NOW','new 52','silver age','golden age','post crisis','rebirth') NOT NULL,
  `publisher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comicrequest`
--

INSERT INTO `comicrequest` (`comic_id`, `user_id`, `name`, `issue_no`, `era`, `publisher`) VALUES
(5, 19, 'The Flash', 123, 'Silver Age', 'DC Comics'),
(9, 19, 'The Flash', 7, 'Silver Age', 'DC Comics'),
(10, 29, 'PJ is a cool dude', 0, 'MARVEL NOW', 'PJ'),
(11, 30, 'The Flash', 123, 'Silver Age', 'DC Comics');

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

CREATE TABLE `comics` (
  `comic_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `issue_no` int(11) NOT NULL,
  `era` enum('Golden Age','Silver Age','Post-Crisis','New 52','Rebirth','golden age','silver age','post crisis','new 52','rebirth','MARVEL NOW','') NOT NULL,
  `publisher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comics`
--

INSERT INTO `comics` (`comic_id`, `name`, `issue_no`, `era`, `publisher`) VALUES
(1, 'The Flash', 123, '', 'DC Comics'),
(2, 'The Flash', 124, 'Silver Age', 'DC Comics'),
(3, 'The Flash', 125, 'Silver Age', 'DC Comics');

-- --------------------------------------------------------

--
-- Table structure for table `comiupload`
--

CREATE TABLE `comiupload` (
  `upload_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `issue_no` int(11) NOT NULL,
  `publisher` varchar(500) NOT NULL,
  `file` longtext NOT NULL,
  `comic_path` longtext NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `upload_id`, `content`, `date`) VALUES
(13, 19, 46, 'asdas', '2017-10-08 17:05:52'),
(15, 19, 49, 'asd', '2017-10-08 23:44:42'),
(18, 19, 56, 'asdsd', '2017-10-09 00:02:46'),
(19, 19, 44, 'asd', '2017-10-09 00:03:06'),
(20, 29, 42, 'bro its really good', '2017-10-12 20:49:53'),
(21, 29, 59, 'this comic is really good. really good details. would recommend\r\n', '2017-10-12 20:52:59'),
(22, 30, 42, 'TEST', '2017-10-13 10:45:11'),
(23, 19, 46, 'asdsa', '2017-10-13 12:22:10'),
(24, 19, 59, 'asdasdasdasdada', '2017-10-13 12:23:55'),
(25, 19, 46, 'asdasdasdasd', '2017-10-13 12:25:09'),
(26, 19, 46, 'sdadasda', '2017-10-13 12:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`image_id`, `user_id`, `image`) VALUES
(1, 15, 'uploads/c96c693a0316646ca479fa9a8f5e46b8.png'),
(2, 1, 'uploads/StormtrooperProfPic.jpg'),
(3, 2, 'uploads/StormtrooperProfPic.jpg'),
(4, 3, 'uploads/StormtrooperProfPic.jpg'),
(5, 4, 'uploads/StormtrooperProfPic.jpg'),
(6, 5, 'uploads/StormtrooperProfPic.jpg'),
(7, 6, 'uploads/StormtrooperProfPic.jpg'),
(8, 7, 'uploads/StormtrooperProfPic.jpg'),
(9, 8, 'uploads/StormtrooperProfPic.jpg'),
(10, 9, 'uploads/StormtrooperProfPic.jpg'),
(11, 10, 'uploads/StormtrooperProfPic.jpg'),
(12, 11, 'uploads/StormtrooperProfPic.jpg'),
(13, 12, 'uploads/StormtrooperProfPic.jpg'),
(14, 13, 'uploads/jpeg-logo-plain.jpeg'),
(15, 14, 'uploads/StormtrooperProfPic.jpg'),
(16, 18, 'uploads/StormtrooperProfPic.jpg'),
(17, 19, 'uploads/safe_image.gif'),
(18, 20, 'uploads/sith_assassin_by_sxeven-d9n2zwj.jpg'),
(19, 21, 'uploads/sith_assassin_by_sxeven-d9n2zwj.jpg'),
(20, 22, 'uploads/StormtrooperProfPic.jpg'),
(21, 23, 'uploads/StormtrooperProfPic.jpg'),
(22, 24, 'uploads/StormtrooperProfPic.jpg'),
(23, 25, 'uploads/StormtrooperProfPic.jpg'),
(24, 26, 'uploads/StormtrooperProfPic.jpg'),
(25, 27, 'uploads/StormtrooperProfPic.jpg'),
(26, 28, 'uploads/StormtrooperProfPic.jpg'),
(27, 29, 'uploads/-------.jpg'),
(28, 30, 'uploads/Captain_Atom.png'),
(29, 31, 'uploads/31e900a3e757a5a066ccb9ef5a9c5fef.png'),
(30, 32, 'uploads/StormtrooperProfPic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmpass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `username`, `email`, `password`, `confirmpass`) VALUES
(1, 'Arrancar123', 'arrancar@gmail.com', '89716ddc163fd9c70929911f6a7247f6', '89716ddc163fd9c70929911f6a7247f6'),
(2, 'shinigami101', 'shinigami@gmail.com', 'f5951bfddf0ed182346d0e58cb2dc658', 'f5951bfddf0ed182346d0e58cb2dc658'),
(3, 'testuser', 'test@gmail.com', '16d7a4fca7442dda3ad93c9a726597e4', '16d7a4fca7442dda3ad93c9a726597e4'),
(4, 'test2', 'test2@gmail.com', 'e75ae08ad157ba2968ce7a604830c792', 'e75ae08ad157ba2968ce7a604830c792'),
(5, 'test3', 'test3@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b'),
(6, 'test4', 'test4@gmail.com', '68053af2923e00204c3ca7c6a3150cf7', '68053af2923e00204c3ca7c6a3150cf7'),
(7, 'user', 'user@gmail.com', 'd93591bdf7860e1e4ee2fca799911215', 'd93591bdf7860e1e4ee2fca799911215'),
(8, 'mexico', 'mexico@gmail.com', '3b53bf9f547e81f02cb4429b881016fa', '3b53bf9f547e81f02cb4429b881016fa'),
(9, 'test5', 'test5@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', '250cf8b51c773f3f8dc8b4be867a9a02'),
(10, 'test6', 'test6@gmail.com', '47d1e990583c9c67424d369f3414728e', '47d1e990583c9c67424d369f3414728e'),
(11, 'test7', 'test7@gmail.com', 'a5e00132373a7031000fd987a3c9f87b', 'a5e00132373a7031000fd987a3c9f87b'),
(12, 'test8', 'test8@gmail.com', '65ded5353c5ee48d0b7d48c591b8f430', '65ded5353c5ee48d0b7d48c591b8f430'),
(13, 'thresa', 'thresa@gmail.com', '640b0e401c5825ce5c7039b539dda751', '640b0e401c5825ce5c7039b539dda751'),
(14, 'test9', 'test9@gmail.com', '9766527f2b5d3e95d4a733fcfb77bd7e', '9766527f2b5d3e95d4a733fcfb77bd7e'),
(15, 'joji', 'joji@gmail.com', 'cff0baf9d3cb825619ec941564758859', 'cff0baf9d3cb825619ec941564758859'),
(17, 'test10', '10@gmail.com', '06409663226af2f3114485aa4e0a23b4', '06409663226af2f3114485aa4e0a23b4'),
(18, '1111', '111@gmail.com', '550a141f12de6341fba65b0ad0433500', '550a141f12de6341fba65b0ad0433500'),
(19, 'Mandy', 'mandygabucan@gmail.com', 'e8008e06909d08bccc344f7e56b1461b', 'e8008e06909d08bccc344f7e56b1461b'),
(20, 'ethan', 'ethanuy10@yahoo.com', 'c98703aed69284552ffffea25a1706d9', 'c98703aed69284552ffffea25a1706d9'),
(21, 'Jdcabusas', 'asdjsaoidnas@lkasndas.com', 'b6b802badb1c14a5513e4e77883b28eb', 'b6b802badb1c14a5513e4e77883b28eb'),
(22, 'alyssa', 'alyssa@yahoo.com', '34b7da764b21d298ef307d04d8152dc5', '34b7da764b21d298ef307d04d8152dc5'),
(23, 'tris', 'tris@gmail.com', '0c74b7f78409a4022a2c4c5a5ca3ee19', '0c74b7f78409a4022a2c4c5a5ca3ee19'),
(24, 'iko', 'ikocatane@gmail.com', 'e210b2d4726eb89e951f1952be84c02f', 'e210b2d4726eb89e951f1952be84c02f'),
(25, 'andrew', 'andrew@gmail.com', '5e5a64089efed35dce87db369a613d6c', '5e5a64089efed35dce87db369a613d6c'),
(26, 'test11`', 'test11@gmail.com', '7e7757b1e12abcb736ab9a754ffb617a', '7e7757b1e12abcb736ab9a754ffb617a'),
(27, 'test12', 'test12@gmail.com', '26408ffa703a72e8ac0117e74ad46f33', '26408ffa703a72e8ac0117e74ad46f33'),
(28, 'test13', 'test13@gmail.com', '33fc3dbd51a8b38a38b1b85b6a76b42b', '33fc3dbd51a8b38a38b1b85b6a76b42b'),
(29, 'PJ', 'johnpaulestalilla@yahoo.com', '5150b74209525297a7cadb148ff79898', '5150b74209525297a7cadb148ff79898'),
(30, 'testt', 'testt@gmail.com', '147538da338b770b61e592afc92b1ee6', '147538da338b770b61e592afc92b1ee6'),
(31, 'tristan', 'ttcatane@gmail.com', '89716ddc163fd9c70929911f6a7247f6', '89716ddc163fd9c70929911f6a7247f6'),
(32, 'test77', 'test77@gmail.com', '83560a75c016ee68f0dd71bf1bb35b84', '83560a75c016ee68f0dd71bf1bb35b84');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reportText` mediumtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `user_id`, `reportText`, `date`) VALUES
(1, 10, 'TEST', '2017-09-24 00:00:00'),
(2, 12, 'TEST 2', '2017-09-24 00:00:00'),
(3, 13, 'THRESA WHY', '2017-09-24 00:00:00'),
(4, 13, 'TEST AGAIN\r\n', '2017-09-24 00:00:00'),
(5, 13, 'TEST TEST TEST\r\n', '2017-09-24 19:56:06'),
(6, 13, 'THE FLASH', '2017-09-24 19:56:44'),
(7, 15, 'I AM JAPANESE', '2017-09-26 10:39:18'),
(8, 21, 'test report', '2017-09-28 20:15:58'),
(9, 19, 'dfsd', '2017-10-10 19:16:51'),
(10, 19, 'asd', '2017-10-10 19:19:02'),
(11, 29, 'PJ is cool is not showing', '2017-10-12 20:48:11'),
(12, 30, 'TEST', '2017-10-13 10:47:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bookmark_id`),
  ADD KEY `fk_user_bookmark` (`user_id`),
  ADD KEY `fk_bookmark_upload` (`upload_id`);

--
-- Indexes for table `comicrequest`
--
ALTER TABLE `comicrequest`
  ADD PRIMARY KEY (`comic_id`),
  ADD KEY `fk_user_comics` (`user_id`);

--
-- Indexes for table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`comic_id`);

--
-- Indexes for table `comiupload`
--
ALTER TABLE `comiupload`
  ADD PRIMARY KEY (`upload_id`),
  ADD KEY `fk_upload_register` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_user_comment` (`user_id`),
  ADD KEY `fk_user_upload` (`upload_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_pictures_register` (`user_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `fk_user_report` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comicrequest`
--
ALTER TABLE `comicrequest`
  MODIFY `comic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `comics`
--
ALTER TABLE `comics`
  MODIFY `comic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comiupload`
--
ALTER TABLE `comiupload`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `fk_bookmark_upload` FOREIGN KEY (`upload_id`) REFERENCES `comiupload` (`upload_id`),
  ADD CONSTRAINT `fk_user_bookmark` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);

--
-- Constraints for table `comicrequest`
--
ALTER TABLE `comicrequest`
  ADD CONSTRAINT `fk_user_comics` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_user_comment` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`),
  ADD CONSTRAINT `fk_user_upload` FOREIGN KEY (`upload_id`) REFERENCES `comiupload` (`upload_id`);

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_register` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_user_report` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
