-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2018 at 04:24 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `post_pic` varchar(15) NOT NULL,
  `post_desc` text NOT NULL,
  `post_location` varchar(200) NOT NULL,
  `post_tel` varchar(10) NOT NULL,
  `post_date` date NOT NULL,
  `post_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'รับแล้วเป็น1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `post_pic`, `post_desc`, `post_location`, `post_tel`, `post_date`, `post_status`) VALUES
(1, 2, 'pic-0001.jpg', 'ให้ฟรีน้องหมาที่บ้านคลอด น่ารักมาก ด.ญ. 6 ด.ช. 3 สนใจติดต่อได้ค่ะ', 'บางแสน ชลบุรี', '0202021122', '2018-10-28', '0'),
(2, 3, 'pic-0002.jpg', 'พบเห็นน้องหมาพิกัดหลัง ม.บูรพา น้องน่าสงสารมากใครสนใจไปดูได้นะ', 'ม.บูรพา', '0888888888', '2018-10-28', '0'),
(3, 3, 'pic-0003.jpg', 'หาบ้านให้น้องหมาพันธุ์ปักค่ะ อยู่หอพักเลี้ยงไม่ได้ อยากให้น้องได้บ้านใหม่ สนใจติดต่อมานะคะ', 'ม.บูรพา', '0888888888', '2018-10-28', '0'),
(4, 2, 'pic-0004.jpg', 'น้องหมาจรจัดแถวบ้านค่ะ สนใจรับเลี้ยงมาดูได้ด้านที่อยู่ข้างล่างได้เลย น้องหิวน่าสงสารมากค่ะ', 'ชลบุรี', '0977777777', '2018-10-28', '0'),
(5, 1, 'pic-0005.jpg', 'น้องหมาน่าสงสารมากครับ ใครอยากรับน้องมาเลี้ยง ติดต่อมาได้นะครับ', 'บางแสน ชลบุรี', '5555555555', '2018-10-28', '0'),
(6, 5, 'pic-0006.jpg', 'น้องหมาน่าสงสารแถวบางแสน', 'ชลบุรี', '1234567890', '2018-10-28', '0'),
(7, 6, 'pic-0007.jpg', 'หมาแถวบ้านผมน่าสงสารมาก ใครอยากนำไปเลี้ยงติดต่อมาที่ผมได้ครับ', 'ชลบุรี', '5555555555', '2018-10-28', '0'),
(8, 7, 'pic-0008.jpg', 'เจ้าแดงข้างบ้านโดนเจ้าของทิ้ง พี่ๆคนไหนสนใจ มารับไปเลี้ยงได้นะคะ', 'จังหวัดเลย', '2222222222', '2018-10-28', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(3) NOT NULL,
  `user_username` varchar(25) NOT NULL,
  `user_password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`) VALUES
(1, 'first', '1'),
(2, 'focus', '12345'),
(3, 'nutcha', '12345'),
(4, 'nacha', '12345'),
(5, 'test', '12345'),
(6, 'naydam', '12345'),
(7, 'nongdang', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `user_id` int(3) NOT NULL,
  `user_fname` varchar(30) NOT NULL,
  `user_lname` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_tel` varchar(10) NOT NULL,
  `user_gender` enum('male','female') NOT NULL DEFAULT 'male'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_tel`, `user_gender`) VALUES
(1, 'first', 'ฟฟฟ', 'first@mail.com', '1111111111', 'male'),
(2, 'โฟกัส', 'กก', 'focus@mail.com', '2222222222', 'female'),
(3, 'แอล', 'นะ', 'ellle@mail.com', '3333333333', 'female'),
(4, 'nutcha', 'sirimongkol', 'nutcha201139@gmail.com', '0888888888', 'male'),
(5, 'test', 'ทดสอบ', 'test@mail.com', '1234567890', 'male'),
(6, 'นายดำ', 'รักหมา', 'naydam@mail.com', '5555555555', 'male'),
(7, 'น้องด่าง', 'ชอบเลี้ยงหมา', 'nongdang@mail.com', '2222222222', 'female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_user_id_post` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD KEY `FK_user_id_user_detail` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_user_id_post` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `FK_user_id_user_detail` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
