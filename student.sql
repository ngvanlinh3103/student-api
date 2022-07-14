-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2022 at 07:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `default_get_name` (IN `name` VARCHAR(12))   BEGIN
	
	SELECT *  FROM default_student WHERE first_name = name;
	SELECT COUNT(*) AS total FROM default_student WHERE first_name = name;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `default_student_delete` (IN `delete_id` INT)   BEGIN

	 DELETE FROM `default_student` WHERE id_student = delete_id;
	 SELECT * from default_student;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `default_student_getid` (IN `fill_id` INT)   BEGIN
	SELECT *  FROM default_student WHERE id_student = fill_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `default_student_get_name` (IN `name` VARCHAR(12))   BEGIN
	
	SELECT *  FROM default_student WHERE first_name = name;
	SELECT COUNT(*) AS total FROM default_student WHERE first_name = name;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `default_student_insert` (IN `first_name` VARCHAR(12), `last_name` VARCHAR(50), `Age` INT(10), `sex` INT(1))   BEGIN
	INSERT INTO `default_student`(`first_name`, `last_name`, `Age`, `sex`) VALUES (first_name,last_name,Age,sex);
	SELECT * FROM default_student WHERE id_student = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `default_student_list` (IN `in_page_number` INT, IN `in_num_rows` INT)   BEGIN
	DECLARE page_number INT;
  DECLARE num_rows INT;
  SET num_rows = ifnull(in_num_rows, 999999999);
  SET page_number = (ifnull(in_page_number, 1) - 1) * num_rows;
	
	SELECT *  FROM default_student LIMIT page_number, num_rows;
	SELECT COUNT(*) AS total FROM default_student;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `default_student_update` (IN `fistname` VARCHAR(12), `last_name` VARCHAR(50), `Age` INT(10), `sex` INT(1), `id` INT)   BEGIN
	
	UPDATE `default_student` SET `first_name`= fistname,`last_name`= last_name,`Age`= Age,`sex`= sex WHERE id_student = id;
	SELECT * FROM default_student WHERE id_student = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `extension_student_delete` (IN `id_de` INT)   BEGIN
	#Routine body goes here...
DELETE FROM `extension_student` WHERE id = id_de ;
SELECT * FROM extension_student;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `extension_student_getid` (IN `id` INT)   BEGIN

	SELECT *  FROM extension_student WHERE id_student = id;
	SELECT COUNT(*) as total FROM extension_student WHERE id_student = id;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `extension_student_insert` (IN `id_student` INT(11), `home` VARCHAR(50), `phone` INT(12), `email` VARCHAR(50), `school` VARCHAR(100))   BEGIN
	INSERT INTO `extension_student`( `id_student`, `hometowns`, `phone`, `email`, `school`) VALUES (id_student, home, phone, email, school);
	SELECT * FROM extension_student WHERE id = LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `extension_student_list` (IN `in_page_number` INT, IN `in_num_rows` INT)   BEGIN
	
	DECLARE page_number INT;
  DECLARE num_rows INT;
  SET num_rows = ifnull(in_num_rows, 999999999);
  SET page_number = (ifnull(in_page_number, 1) - 1) * num_rows;
	
	SELECT *  FROM extension_student LIMIT page_number, num_rows;
	SELECT COUNT(*) AS total FROM extension_student;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `extension_student_update` (IN `id_student` INT(11), `home` VARCHAR(50), `phone` INT(12), `email` VARCHAR(50), `school` VARCHAR(100), `id_up` INT(5))   BEGIN
	#Routine body goes here...
	UPDATE `extension_student` SET `id_student`= id_student,`hometowns`= home ,`phone`=phone,`email`=email,`school`=school  WHERE id = id_up ;
	SELECT * FROM extension_student WHERE id = id_up;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_get_id` (IN `fill_id_student` INT)   BEGIN
	#Routine body goes here...
	 SELECT `default_student`.`first_name`,`default_student`.`last_name`,`default_student`.`sex`,`default_student`.`Age`,
   `extension_student`.`hometowns`,`extension_student`.`phone`, `extension_student`.`email`,`extension_student`.`school` 
   FROM `default_student` INNER JOIN `extension_student` ON `default_student`.id_student = extension_student.id_student 
   WHERE `extension_student`.`id_student`= fill_id_student;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_get_name` (IN `name` VARCHAR(12))   BEGIN
	
	SELECT SQL_CALC_FOUND_ROWS `default_student`.`first_name`,`default_student`.`last_name`,`default_student`.`sex`,`default_student`.`Age`,`extension_student`.`hometowns`,`extension_student`.`phone`, `extension_student`.`email`,`extension_student`.`school` FROM `default_student` INNER JOIN `extension_student` ON `default_student`.id_student = extension_student.id_student WHERE first_name = name;
		
		SELECT FOUND_ROWS() total;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_list` ()   BEGIN

	SELECT `default_student`.`first_name`,`default_student`.`last_name`,`default_student`.`sex`,`default_student`.`Age`,
   `extension_student`.`hometowns`,`extension_student`.`phone`, `extension_student`.`email`,`extension_student`.`school` 
   FROM `default_student` INNER JOIN `extension_student` ON `default_student`.id_student = extension_student.id_student;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `default_student`
--

CREATE TABLE `default_student` (
  `id_student` int(5) NOT NULL,
  `first_name` varchar(12) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `Age` int(10) NOT NULL,
  `sex` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `default_student`
--

INSERT INTO `default_student` (`id_student`, `first_name`, `last_name`, `Age`, `sex`) VALUES
(1, 'Linh', 'Nguyễn Văn', 25, 1),
(2, 'Đô', 'Nguyễn Văn', 28, 1),
(5, 'Anh', 'Nguyễn Đình', 21, 1),
(6, 'Lương', 'Dương Thị Ngọc', 21, 2),
(7, 'Minh', 'Nguyễn Thị Thu', 21, 2),
(8, 'Út', 'Nguyễn Thị', 21, 2),
(9, 'Nga', 'Nguyễn Thị', 19, 2),
(10, 'Na', 'Nguyễn Thị', 17, 2),
(14, 'nam', 'nguyenthanh', 12, 1),
(16, 'Tứ', 'Nguyễn Quang', 32, 1),
(17, 'Vũ', 'Phan Anh', 28, 1),
(18, 'Cả', 'Phan Thế', 24, 1),
(20, 'Linh', 'Lê La', 12, 1),
(40, 'Dâu', 'Dương Thị', 9, 2),
(46, 'Mít', 'Dương Thị', 1, 2),
(47, 'Đạo', 'Bá Văn', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `extension_student`
--

CREATE TABLE `extension_student` (
  `id` int(5) NOT NULL,
  `id_student` int(11) NOT NULL,
  `hometowns` varchar(50) NOT NULL,
  `phone` int(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `school` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extension_student`
--

INSERT INTO `extension_student` (`id`, `id_student`, `hometowns`, `phone`, `email`, `school`) VALUES
(1, 1, 'Hà Nội', 369348633, 'ngvanlinh3103@gmail.com', 'HAUI'),
(2, 2, 'Hà Nội', 365151515, 'ngvando@gmail.com', 'Bach Khoa'),
(4, 5, 'Hà Nội', 2147483647, 'dinhanh@gmail.com', 'HAUI'),
(5, 6, 'Thái Nguyên', 365567545, 'ngocluong@gmail.com', 'sư phạm'),
(6, 8, 'Hà Nội', 93124423, 'thiut@gmail.com', 'NEU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `default_student`
--
ALTER TABLE `default_student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `extension_student`
--
ALTER TABLE `extension_student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `default_student`
--
ALTER TABLE `default_student`
  MODIFY `id_student` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `extension_student`
--
ALTER TABLE `extension_student`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
