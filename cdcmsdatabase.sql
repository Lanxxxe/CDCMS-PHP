-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2025 at 06:57 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdcmsdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` text,
  `upload_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `date_posted` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `posted_by`, `title`, `picture`, `upload_date`, `description`, `date_posted`) VALUES
(14, 'Teacher Theres', 'update', '67d2fc1f3fc0a.png', '2025-03-13 23:37:54', 'asd', '2025-03-13 15:37:54'),
(15, 'Teacher Theres', 'test', 'test.jpeg', '2025-03-13 23:41:26', 'test', '2025-03-13 15:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `date`, `status`) VALUES
(31, 29, '2025-03-13 00:00:00', 'Present'),
(32, 29, '2025-03-12 00:00:00', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `schedule` text NOT NULL,
  `psa` text,
  `immunizationcard` text,
  `recentphoto` text,
  `guardianqcid` text
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `student_id`, `schedule`, `psa`, `immunizationcard`, `recentphoto`, `guardianqcid`) VALUES
(21, 29, 'K1', '../enrollment_process/uploads/files/nasir_sammy/psa/nasir_sammy_psa.png', NULL, NULL, '../enrollment_process/uploads/files/nasir_sammy/guardianqcid/nasir_sammy_guardianqcid.jpeg'),
(22, 30, 'K3', 'uploads/files/carlotta_lincoln/psa/carlotta_lincoln_psa.png', NULL, NULL, 'uploads/files/carlotta_lincoln/qcid/carlotta_lincoln_qcid.png');

-- --------------------------------------------------------

--
-- Table structure for table `father_info`
--

CREATE TABLE `father_info` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact_number` bigint NOT NULL
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardian_info`
--

CREATE TABLE `guardian_info` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `contact_number` bigint NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `guardian_info`
--

INSERT INTO `guardian_info` (`id`, `student_id`, `firstname`, `middlename`, `lastname`, `relationship`, `contact_number`, `occupation`, `email`) VALUES
(24, 29, 'Johnpaul', 'Araceli', 'Daniel', 'Mother', 153179147, 'Ullam reiciendis laudantium ullam voluptatem consequatur repellat ipsum pariatur aut.', 'your.email+fakedata62371@gmail.com'),
(25, 30, 'Bernard', 'Frieda', 'Volkman', 'Mother', 322929789, 'Ipsum quos eum reiciendis reprehenderit illum maxime voluptates nisi animi.', 'your.email+fakedata19260@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mother_info`
--

CREATE TABLE `mother_info` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact_number` bigint NOT NULL
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `content` text,
  `file_path` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `name`, `action`, `content`, `file_path`, `is_read`, `date_created`) VALUES
(10, 'Nasir Chelsey Sammy jr', 'update', 'Guardian has updated the PSA Birth Certificate for Nasir Chelsey Sammy jr', '../enrollment_process/uploads/files/Nasir_Sammypsapsa_29_1741885718.png', 1, '2025-03-13 17:08:38'),
(13, 'Nasir Chelsey Sammy jr', 'update', 'Guardian has updated the PSA Birth Certificate for Nasir Chelsey Sammy jr', 'uploads/files/nasir_sammy/psa/nasir_sammy_psa.png', 1, '2025-03-13 17:17:36'),
(14, 'Nasir Chelsey Sammy jr', 'update', 'Guardian has updated the PSA Birth Certificate for Nasir Chelsey Sammy jr', 'uploads/files/nasir_sammy/psa/nasir_sammy_psa.png', 1, '2025-03-13 17:19:45'),
(15, 'Nasir Chelsey Sammy jr', 'update', 'Guardian has updated the PSA Birth Certificate for Nasir Chelsey Sammy jr', 'uploads/files/nasir_sammy/psa/nasir_sammy_psa.png', 1, '2025-03-13 17:21:55'),
(16, 'Nasir Chelsey Sammy jr', 'update', 'Guardian has updated the PSA Birth Certificate for Nasir Chelsey Sammy jr', 'uploads/files/nasir_sammy/psa/nasir_sammy_psa.png', 1, '2025-03-13 17:21:58'),
(17, 'Nasir Chelsey Sammy jr', 'update', 'Guardian has updated the PSA Birth Certificate for Nasir Chelsey Sammy jr', 'uploads/files/nasir_sammy/psa/nasir_sammy_psa.png', 1, '2025-03-13 17:23:13'),
(18, 'Nasir Chelsey Sammy jr', 'update', 'Guardian has updated the Immunization Card for Nasir Chelsey Sammy jr', 'uploads/files/nasir_sammy/immunizationcard/nasir_sammy_immunizationcard.png', 1, '2025-03-13 17:23:26'),
(22, 'Nasir Chelsey Sammy jr', 'delete', 'Guardian has deleted the Immunization Card for Nasir Chelsey Sammy jr', '../enrollment_process/uploads/files/nasir_sammy/immunizationcard/nasir_sammy_immunizationcard.png', 1, '2025-03-13 17:51:52'),
(23, 'Nasir Chelsey Sammy jr', 'add', 'Guardian has added the Guardian QC ID for Nasir Chelsey Sammy jr', '../enrollment_process/uploads/files/nasir_sammy/guardianqcid/nasir_sammy_guardianqcid.jpeg', 1, '2025-03-13 17:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE `recommendation` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `evaluation_period` varchar(20) DEFAULT NULL,
  `recommendation` text
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `recommendation`
--

INSERT INTO `recommendation` (`id`, `student_id`, `evaluation_period`, `recommendation`) VALUES
(7, 29, '1st', 'Evaluation Report for Nasir Chelsey Sammy jr (K1) - 1st Evaluation Period\n\nOverall Assessment:\nThe student is showing excellent progress across most developmental areas. \n\nStrengths:\nThe student demonstrates strong abilities in gross motor skills, fine motor skills, self-help skills, receptive language, expressive language, cognitive skills, socio-emotional skills. Continue to provide opportunities to further develop these skills.\n\nNext Steps:\n1. Continue to monitor progress in all developmental areas.\n2. Implement the suggested activities to support areas needing improvement.\n3. Maintain regular communication with parents/guardians about the student\'s progress.\n4. Consider a follow-up assessment in 2-3 months to track improvement.'),
(8, 29, '2nd', 'Evaluation Report for Nasir Chelsey Sammy jr (K1) - 2nd Evaluation Period\n\nOverall Assessment:\nThe student is showing excellent progress across most developmental areas. \n\nStrengths:\nThe student demonstrates strong abilities in expressive language. Continue to provide opportunities to further develop these skills.\n\nAreas for Improvement:\nThe student would benefit from additional support in gross motor skills, fine motor skills, self-help skills, receptive language, cognitive skills, socio-emotional skills. \n\nIncorporate more physical activities like obstacle courses, ball games, and dancing. These activities help develop coordination, balance, and strength.\n\nProvide opportunities for drawing, cutting with scissors, stringing beads, and manipulating small objects. These activities help develop hand-eye coordination and finger dexterity.\n\nEncourage independence in daily routines like dressing, eating, and personal hygiene. Break tasks into smaller steps and provide positive reinforcement.\n\nRead books together daily, play listening games, and give clear, simple instructions. Ensure the student understands by asking them to repeat or demonstrate understanding.\n\nIntroduce puzzles, sorting activities, and simple problem-solving games. Ask questions that promote critical thinking and provide opportunities for exploration and discovery.\n\nCreate opportunities for cooperative play, teach emotional vocabulary, and model appropriate ways to express feelings. Use role-play to practice social situations.\n\nNext Steps:\n1. Continue to monitor progress in all developmental areas.\n2. Implement the suggested activities to support areas needing improvement.\n3. Maintain regular communication with parents/guardians about the student\'s progress.\n4. Consider a follow-up assessment in 2-3 months to track improvement.');

-- --------------------------------------------------------

--
-- Table structure for table `registerlanding`
--

CREATE TABLE `registerlanding` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `session_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `standard_scores`
--

CREATE TABLE `standard_scores` (
  `id` int NOT NULL,
  `semester` enum('First','Second') NOT NULL,
  `gross_motor` int NOT NULL,
  `fine_motor` int NOT NULL,
  `self_help` int NOT NULL,
  `receptive_language` int NOT NULL,
  `expressive_language` int NOT NULL,
  `cognitive` int NOT NULL,
  `socio_emotional` int NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `standard_scores`
--

INSERT INTO `standard_scores` (`id`, `semester`, `gross_motor`, `fine_motor`, `self_help`, `receptive_language`, `expressive_language`, `cognitive`, `socio_emotional`, `date_created`) VALUES
(1, 'First', 8, 8, 19, 4, 6, 19, 20, '2025-03-09 14:55:35'),
(2, 'Second', 13, 11, 26, 5, 8, 21, 24, '2025-03-09 14:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `age` int NOT NULL,
  `sex` varchar(10) NOT NULL,
  `healthhistory` varchar(255) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `firstname`, `middlename`, `lastname`, `suffix`, `birthdate`, `age`, `sex`, `healthhistory`, `date_created`) VALUES
(29, 'AY2425-01', 'Nasir', 'Chelsey', 'Sammy', 'jr', '2020-07-03', 4, 'Male', 'Ullam nisi nisi odio recusandae earum ipsam veniam nesciunt.', '2025-03-13 15:10:21'),
(30, 'AY2425-02', 'Carlotta', 'Shaniya', 'Lincoln', '', '2020-03-03', 5, 'Female', 'Nisi vitae explicabo cupiditate eum amet dolorem quos.', '2025-03-13 18:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_address`
--

CREATE TABLE `student_address` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `address_no` int NOT NULL,
  `baranggay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_address`
--

INSERT INTO `student_address` (`id`, `student_id`, `address_no`, `baranggay`, `municipality`) VALUES
(25, 29, 84, 'Earum assumenda dolor nesciunt sed deleniti minus quo consequatur.', 'Quezon City'),
(26, 30, 83008, 'Animi ducimus quod iusto quam quasi ducimus.', 'Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `student_evaluation`
--

CREATE TABLE `student_evaluation` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `evaluation_period` varchar(10) NOT NULL,
  `gross_motor_score` int DEFAULT NULL,
  `fine_motor_score` int DEFAULT NULL,
  `self_help_score` int DEFAULT NULL,
  `receptive_language_score` int DEFAULT NULL,
  `expressive_language_score` int DEFAULT NULL,
  `cognitive_score` int DEFAULT NULL,
  `socio_emotional_score` int DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_evaluation`
--

INSERT INTO `student_evaluation` (`id`, `student_id`, `evaluation_period`, `gross_motor_score`, `fine_motor_score`, `self_help_score`, `receptive_language_score`, `expressive_language_score`, `cognitive_score`, `socio_emotional_score`, `date_created`) VALUES
(6, 29, '1st', 12, 42, 23, 32, 23, 21, 12, '2025-03-13 15:11:06'),
(7, 29, '2nd', 2, 2, 3, 4, 42, 2, 1, '2025-03-13 18:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `first_name` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8_general_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `middle_name`, `birthday`, `address`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', NULL, NULL, NULL, 'john@gmail.com', '$2y$10$g9Ry9GFsiL0CZGc.cj7/TehncUh6I/fWUX97o7OG7JJI5IhI2/9yu', 'teacher', '2025-03-13 07:19:38', '2025-03-13 07:19:38'),
(5, 'Casey', 'White', NULL, NULL, NULL, 'casey@gmail.com', '$2y$10$0e0I5.C4i.g4S3FKQEEBCumjGfKIvegIQeKSVCm5m57aOcSO8vhDi', 'guardian', '2025-03-13 11:22:09', '2025-03-13 11:22:59'),
(6, 'Sam', 'Taylor', NULL, NULL, NULL, 'sam@gmail.com', '$2y$10$XRPk/1lQ.mXwZeCjSRwH.OQRuHh4.OgU5ubGlb6QwhMUL4vMRaXy6', 'teacher', '2025-03-13 11:24:07', '2025-03-13 11:24:33'),
(7, 'michael', 'juan', NULL, NULL, NULL, 'test@gmail.com', '$2y$10$ymhLVeRgnynaMKY8btqqSuSKfu02C5Gq4bwGkR1z8yDXY8xSU/doC', 'teacher', '2025-03-13 18:23:09', '2025-03-13 18:53:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `father_info`
--
ALTER TABLE `father_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `guardian_info`
--
ALTER TABLE `guardian_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `mother_info`
--
ALTER TABLE `mother_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `registerlanding`
--
ALTER TABLE `registerlanding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standard_scores`
--
ALTER TABLE `standard_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `student_address`
--
ALTER TABLE `student_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_evaluation`
--
ALTER TABLE `student_evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `father_info`
--
ALTER TABLE `father_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guardian_info`
--
ALTER TABLE `guardian_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mother_info`
--
ALTER TABLE `mother_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `recommendation`
--
ALTER TABLE `recommendation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registerlanding`
--
ALTER TABLE `registerlanding`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `standard_scores`
--
ALTER TABLE `standard_scores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `student_address`
--
ALTER TABLE `student_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `student_evaluation`
--
ALTER TABLE `student_evaluation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `father_info`
--
ALTER TABLE `father_info`
  ADD CONSTRAINT `father_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guardian_info`
--
ALTER TABLE `guardian_info`
  ADD CONSTRAINT `guardian_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mother_info`
--
ALTER TABLE `mother_info`
  ADD CONSTRAINT `mother_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD CONSTRAINT `recommendation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_address`
--
ALTER TABLE `student_address`
  ADD CONSTRAINT `student_address_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_evaluation`
--
ALTER TABLE `student_evaluation`
  ADD CONSTRAINT `student_evaluation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
