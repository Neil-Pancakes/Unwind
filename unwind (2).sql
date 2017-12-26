-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: den1.mysql2.gear.host
-- Generation Time: Dec 26, 2017 at 10:00 AM
-- Server version: 5.6.29
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unwind`
--

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `check_in_id` int(11) NOT NULL,
  `check_in_start` datetime NOT NULL,
  `check_in_end` datetime NOT NULL,
  `reservation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact_no` varchar(16) DEFAULT NULL,
  `date_account_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `position`, `first_name`, `last_name`, `middle_initial`, `email`, `birthdate`, `gender`, `contact_no`, `date_account_created`) VALUES
(1, 'Admin', 'Neil Patrick', 'Llenes', 'D', 'neil.llenes@gmail.com', '1997-11-13', 'Male', '09339356829', '2017-11-07 21:20:20'),
(2, 'Janitor', 'Dave', 'Concepcion', 'L', 'dave@gmail.com', '1997-10-20', 'Male', '09111111111', '2017-11-08 09:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `comment` text NOT NULL,
  `check_in_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `floor_id` int(11) NOT NULL,
  `floor_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`floor_id`, `floor_number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `price` float NOT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `name`, `description`, `price`, `menu_id`) VALUES
(1, 'Chicken', '1 whole chicken grilled to perfection', 400, 1),
(2, 'Plain Rice', 'Platter of plain rice hunted down from the plains of Africa', 250, 1),
(3, 'Chocolate Milk', 'Milk from chocolate cows', 500, 1),
(4, 'Pork', 'Scrumptious pork!', 175, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_item`
--

CREATE TABLE `food_item` (
  `food_item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `food_order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `food_order_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `timestamp_ordered` datetime NOT NULL,
  `check_in_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `name`) VALUES
(1, 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `reservation_status` enum('Waiting','Checked-in','Cancelled') NOT NULL DEFAULT 'Waiting',
  `reservation_request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reservation_status`, `reservation_request_id`) VALUES
(1, 'Checked-in', 11);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_request`
--

CREATE TABLE `reservation_request` (
  `reservation_request_id` int(11) NOT NULL,
  `reservation_request_date` datetime NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `adult_qty` int(11) NOT NULL,
  `child_qty` int(11) NOT NULL DEFAULT '0',
  `reservation_request_status` enum('Accepted','Rejected','Pending') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation_request`
--

INSERT INTO `reservation_request` (`reservation_request_id`, `reservation_request_date`, `checkin_date`, `checkout_date`, `adult_qty`, `child_qty`, `reservation_request_status`, `user_id`, `employee_id`) VALUES
(4, '2017-11-18 04:39:26', '2017-11-20', '2017-11-23', 0, 0, '', 5, NULL),
(5, '2017-11-22 16:55:43', '2017-11-29', '2017-12-08', 0, 0, 'Pending', 5, NULL),
(6, '2017-11-25 01:12:18', '2017-12-19', '2017-12-23', 0, 0, 'Pending', 5, NULL),
(7, '2017-11-25 01:23:00', '2018-03-15', '2018-04-15', 0, 0, 'Accepted', 5, 1),
(8, '2017-11-25 01:41:08', '2018-05-15', '2018-05-20', 0, 0, 'Accepted', 5, 1),
(9, '2017-11-25 01:44:37', '2018-06-15', '2018-06-18', 0, 0, 'Accepted', 5, 1),
(10, '2017-12-17 13:54:20', '2017-12-18', '2018-05-15', 0, 0, '', 5, NULL),
(11, '2017-12-25 14:30:23', '2017-12-26', '2018-01-13', 1, 0, 'Accepted', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_status` enum('Available','Occupied','Unavailable') NOT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_number`, `room_status`, `room_type_id`, `floor_id`) VALUES
(1, 101, 'Available', 1, 1),
(2, 102, 'Available', 1, 1),
(3, 103, 'Available', 1, 1),
(4, 401, 'Available', 2, 4),
(5, 402, 'Available', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `room_reserved`
--

CREATE TABLE `room_reserved` (
  `room_reserved_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `reservation_request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_reserved`
--

INSERT INTO `room_reserved` (`room_reserved_id`, `room_id`, `reservation_request_id`) VALUES
(1, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `description` text,
  `max_adult` int(11) NOT NULL,
  `max_child` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`room_type_id`, `name`, `price`, `description`, `max_adult`, `max_child`) VALUES
(1, 'Regular', 10000, 'Standard Room', 2, 2),
(2, 'Suite', 25000, 'A beautiful suite', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE `service_request` (
  `service_request_id` int(11) NOT NULL,
  `service_request_date` datetime NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `check_in_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact_no` varchar(16) DEFAULT NULL,
  `date_account_created` datetime NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `first_name`, `last_name`, `middle_initial`, `email`, `birthdate`, `gender`, `contact_no`, `date_account_created`, `password`) VALUES
(1, 'Robin Dalmy', 'Tubungbanua', 'M', 'dalmiet@gmail.com', '1997-10-19', 'Male', '09091234567', '2017-11-07 21:21:33', ''),
(5, 'Jesus', 'Ramos', 'M', 'robin@gmail.com', '1994-05-15', 'Male', '09254430683', '2017-11-12 04:16:48', '$2y$10$m33rrgoXE2oolU0Y2ARuMebKvY5WLvng/BL/GljpNgMek9MjHFXRm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`check_in_id`),
  ADD KEY `check_in_fk1` (`reservation_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback_fk1` (`check_in_id`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `food_fk1` (`menu_id`);

--
-- Indexes for table `food_item`
--
ALTER TABLE `food_item`
  ADD PRIMARY KEY (`food_item_id`),
  ADD KEY `food_item_fk1` (`food_id`),
  ADD KEY `food_item_fk2` (`food_order_id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`food_order_id`),
  ADD KEY `food_order_fk1` (`check_in_id`),
  ADD KEY `food_order_fk2` (`employee_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `reservation_fk1` (`reservation_request_id`);

--
-- Indexes for table `reservation_request`
--
ALTER TABLE `reservation_request`
  ADD PRIMARY KEY (`reservation_request_id`),
  ADD KEY `reservation_request_fk1` (`user_id`),
  ADD KEY `reservation_request_fk2` (`employee_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_fk1` (`room_type_id`),
  ADD KEY `room_fk2` (`floor_id`);

--
-- Indexes for table `room_reserved`
--
ALTER TABLE `room_reserved`
  ADD PRIMARY KEY (`room_reserved_id`),
  ADD KEY `room_reserved_fk1` (`room_id`),
  ADD KEY `room_reserved_fk2` (`reservation_request_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_request`
--
ALTER TABLE `service_request`
  ADD PRIMARY KEY (`service_request_id`),
  ADD KEY `service_request_fk1` (`service_id`),
  ADD KEY `service_request_fk2` (`employee_id`),
  ADD KEY `service_request_fk3` (`check_in_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `check_in_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `food_item`
--
ALTER TABLE `food_item`
  MODIFY `food_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `food_order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reservation_request`
--
ALTER TABLE `reservation_request`
  MODIFY `reservation_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `room_reserved`
--
ALTER TABLE `room_reserved`
  MODIFY `room_reserved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_request`
--
ALTER TABLE `service_request`
  MODIFY `service_request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `check_in`
--
ALTER TABLE `check_in`
  ADD CONSTRAINT `check_in_fk1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_fk1` FOREIGN KEY (`check_in_id`) REFERENCES `check_in` (`check_in_id`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_fk1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`);

--
-- Constraints for table `food_item`
--
ALTER TABLE `food_item`
  ADD CONSTRAINT `food_item_fk1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`),
  ADD CONSTRAINT `food_item_fk2` FOREIGN KEY (`food_order_id`) REFERENCES `food_order` (`food_order_id`);

--
-- Constraints for table `food_order`
--
ALTER TABLE `food_order`
  ADD CONSTRAINT `food_order_fk1` FOREIGN KEY (`check_in_id`) REFERENCES `check_in` (`check_in_id`),
  ADD CONSTRAINT `food_order_fk2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_fk1` FOREIGN KEY (`reservation_request_id`) REFERENCES `reservation_request` (`reservation_request_id`);

--
-- Constraints for table `reservation_request`
--
ALTER TABLE `reservation_request`
  ADD CONSTRAINT `reservation_request_fk1` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`),
  ADD CONSTRAINT `reservation_request_fk2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_fk1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`room_type_id`),
  ADD CONSTRAINT `room_fk2` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`floor_id`);

--
-- Constraints for table `room_reserved`
--
ALTER TABLE `room_reserved`
  ADD CONSTRAINT `room_reserved_fk1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `room_reserved_fk2` FOREIGN KEY (`reservation_request_id`) REFERENCES `reservation_request` (`reservation_request_id`);

--
-- Constraints for table `service_request`
--
ALTER TABLE `service_request`
  ADD CONSTRAINT `service_request_fk1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `service_request_fk2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `service_request_fk3` FOREIGN KEY (`check_in_id`) REFERENCES `check_in` (`check_in_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
