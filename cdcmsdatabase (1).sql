-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2025 at 03:38 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recommendation`
--

INSERT INTO `recommendation` (`id`, `student_id`, `evaluation_period`, `recommendation`) VALUES
(9, 30, '1st', 'Evaluation Report for Carlotta Shaniya Lincoln  (K3) - 1st Evaluation Period\n\nOverall Assessment:\nThe student needs additional support in several developmental areas. \n\nAreas for Improvement:\nThe student would benefit from additional support in gross motor skills, fine motor skills, self-help skills, receptive language, expressive language, cognitive skills, socio-emotional skills. \n\nIncorporate more physical activities like obstacle courses, ball games, and dancing. These activities help develop coordination, balance, and strength.\n\nProvide opportunities for drawing, cutting with scissors, stringing beads, and manipulating small objects. These activities help develop hand-eye coordination and finger dexterity.\n\nEncourage independence in daily routines like dressing, eating, and personal hygiene. Break tasks into smaller steps and provide positive reinforcement.\n\nRead books together daily, play listening games, and give clear, simple instructions. Ensure the student understands by asking them to repeat or demonstrate understanding.\n\nEngage in conversations, ask open-ended questions, and encourage the student to describe activities, feelings, and experiences. Model correct language use without criticism.\n\nIntroduce puzzles, sorting activities, and simple problem-solving games. Ask questions that promote critical thinking and provide opportunities for exploration and discovery.\n\nCreate opportunities for cooperative play, teach emotional vocabulary, and model appropriate ways to express feelings. Use role-play to practice social situations.\n\nNext Steps:\n1. Continue to monitor progress in all developmental areas.\n2. Implement the suggested activities to support areas needing improvement.\n3. Maintain regular communication with parents/guardians about the student\'s progress.\n4. Consider a follow-up assessment in 2-3 months to track improvement.');

-- --------------------------------------------------------

--
-- Table structure for table `registerlanding`
--

CREATE TABLE `registerlanding` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `session_token` varchar(500) DEFAULT NULL,
  `picture_pic` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `working` varchar(15) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `house` varchar(50) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registerlanding`
--

INSERT INTO `registerlanding` (`id`, `email`, `first_name`, `last_name`, `session_token`, `picture_pic`, `birth_date`, `sex`, `mobile`, `working`, `occupation`, `house`, `street`, `barangay`, `city`, `password`, `created_at`) VALUES
(18, 'superadmin@gmail.com', 'Super', 'Admin', NULL, NULL, '1970-01-01', 'MALE', '', 'yes', NULL, NULL, '', '', '', '$2y$10$H.cdxue3moAKIEi4RPQ/d.BHEU8isojv7JavGj2DZMYYxtzqkk/pq', '2025-03-14 15:29:10'),
(57, 'wendhil10@gmail.com', 'Wendhil', 'Himarangan', NULL, NULL, '2002-11-11', 'MALE', '09081031241', 'yes', 'student', '128', 'sitio pajo', 'Baesa', 'Quezon City', '$2y$10$K8b/CxDASpOh8Wd8GBnZ5.UCGaqFuSpqburDjsRap0Xj9biB1A.HG', '2025-03-14 15:29:10'),
(58, 'sardoncillolemuel@gmail.com', 'Lemuel James', 'Leonora', '03530340fc6586a90d58f8d26f27039077e290b1266c1756ebb083f7b380dcfb', NULL, '1970-01-01', 'MALE', '09565632432', 'yes', 'IT Student', '62', 'Almar', 'Tatalon', 'Quezon City', '$2y$10$l19gMmkqvkRAlZFUOIBdHurkCY1ujHkZfBgDGn7eh4rwk2tXnT1IW', '2025-03-14 15:29:10'),
(59, 'edgeniel16@gmail.com', 'edgeniel', 'buhian', NULL, NULL, '1970-01-01', 'MALE', '09152130678', 'yes', 'student', '14', 'kaingin', 'Pansol', 'quezon city', '$2y$10$xWczirsTcS0Rjfbb9CYsmuBaSwKZXkScNTkcZaujDUDJXwq2HGCdK', '2025-03-14 15:29:10'),
(60, 'daveprotacio48@gmail.com', 'dave', 'protacio', '3a1f4ea023c4747d8870060768215d478d1ff256f5fe3a58bbfddfa22d6f4be9', NULL, '1970-01-01', 'MALE', '09196595120', 'yes', 'student', '1oldcabuyao', 'LIPTON STREET', 'Sauyo', 'quezon city', '$2y$10$L7PxkmiGeC19ktBNqu92nuVttHqd.9hxw29b1VHsdA/O5DpqqgbtK', '2025-03-14 15:29:10'),
(61, 'sample@gmail.com', 'test', 'test', 'cff4081776e149c07101586ea0347c03317bd5629d6df68843bf192528bce415', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$bzYHXIgF2zIuJq/W.9dx2OTnjIHlgPSfFhMy2JdhgL9t2bUMnEZgm', '2025-03-14 15:29:10'),
(62, 'wendhil09@gmail.com', 'wendhil', 'himarangan', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$8F8Fzj/ZBzZP6yX9wsyOIe7XAD/tFqyfWnOBYzVLgZcya7ASEEZAu', '2025-03-14 15:29:10'),
(63, 'tranterfk@gmail.com', 'JQolNCIaZZiO', 'tTCZnYCIuy', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$oFuRPlAt9UC88RpzHb23uOciF5yFOb1vGxlWzTx8/D/zkcem9XgNK', '2025-03-14 15:29:10'),
(64, 'bcp@admin.com', 'cute', 'cute', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$h2mzhefd6cPLLrXgIDJ.d.KXlxo8ZwPS5ZUqBNCyDXg.kW6XOOyHq', '2025-03-14 15:29:10'),
(65, 'capzlock35@gmail.com', 'Capz', 'Lock', 'e312960fb1c17e54d87d8c4e4de3b1ca855d1554519c5425cdea32cecbc82409', NULL, '2002-05-11', 'MALE', '09123456789', 'no', 'Student', '69', '69 420 Street', 'West Crame', 'Sanjuan CIty', '$2y$10$e2i4cqhVg8Ng/M6YgDMC0.5VDUXZAtkmEWXpGbafoaQHhhqaNtA6i', '2025-03-14 15:29:10'),
(66, 'ajcoderpregoner34@gmail.com', 'art', 'art', 'f87d43099ba390c8aa09620c38f55a63f8a0673b0428de1a2a99095734b59281', NULL, '1970-01-01', 'MALE', '09626959580', 'yes', 'secret', 'secret', 'Circle', 'Cutie', 'Quezon City', '$2y$10$VH5J5JkXMI9DXR9gHGxINOqH6m8msklXxc9KPHb5UlKDkBDSEPgS6', '2025-03-14 15:29:10'),
(67, 'johndoe@gmail.com', 'John', 'Doe', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$xvQWZCLlHIXrQlZl7pPe6.s0fdQbJTbKwBvBh5f9ktE0eUdTZHEPK', '2025-03-14 15:29:10'),
(68, 'akirafranse@gmail.com', 'Akira', 'Ybañez', '2d7a69ae2b90d815718c14af10d3f538eb634d515ca81ed51d2e249cf0164ffe', NULL, '2001-09-14', 'MALE', '09984217289', 'yes', 'Student', '054', 'Sampaguita street', 'Payatas', 'Quezon City', '$2y$10$a54YS9/xAtBHno2kiKgCaOSi5Z.raOKsiqT3XyeEV.QFK775HUaay', '2025-03-14 15:29:10'),
(69, 'loyiwak621@payposs.com', 'bekbek', 'neneng', '603c3531d3b44e733d71c2887cf3d315514afd4e272af0e178114283aeaa7202', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$rhQuoixEVkBYHkm3rXCv9ODDGvAMroIcbn9LR5C.CvV5sOKz0q/nW', '2025-03-14 15:29:10'),
(70, 'christiancainglet28@gmail.com', 'christian', 'cainglet', 'c73eb1947a001bc592d52b5098c2f821971d6825600151ad8411ccfc134d9fe3', NULL, '1970-01-01', 'MALE', '09999999999', 'yes', 'fghjk', '345678df', '4567890ds', 'fghjkl', 'fghjkl', '$2y$10$tkcffVbgspZtEDvNaXhd2u6MSoiM1Fxr6XnMf9/p5fXt3MD41aCZy', '2025-03-14 15:29:10'),
(71, 'reyreyreyrey909@gmail.com', 'Railand', 'Gran', NULL, NULL, '2003-04-24', 'MALE', '09458747069', 'yes', 'Student', '31', 'Dama De Necho Street', 'Payatas A', 'Quezon City', '$2y$10$.jUnLwIEubR9UeXeUdodpO/6.TBSEtF3CfJlBNc7dSziMqfyVzi.u', '2025-03-14 15:29:10'),
(72, 'tepasebrayan@gmail.com', 'Rick Brian', 'Tepase', '2fdade3efa7eb45f74b23d2c34042850b292da0ae1cbceff394d7cb5f77a0400', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$uNFvupdp158RBZ9.EhtMlOa9Wc8d08/E0HKalqRm2QFaNrHqssBsS', '2025-03-14 15:29:10'),
(73, 'foreducation49@gmail.com', 'Rick Brian', 'Tepase', '4238fbd67b27b078525b46f4bb8865630224a810c2ca7254456b15576a3407f1', NULL, '1970-01-01', 'MALE', '09303327150', 'no', 'NA', '104', 'Aguinaldo st veterans village pasong tamo qc', 'bagong bayan', 'quezon city', '$2y$10$NBrnlf.gnQ9b2UglggtyhuOJj5/URRunkVqgTMXRbBv4E7SLBtQP2', '2025-03-14 15:29:10'),
(74, 'blake.wayscherer@gmail.com', 'FreddyHofCK', 'FreddyHofCK', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$YEE78g70oKDEXIXyl/AVYObJ4YsJnwIx/wW5NOBztvLII0hbh6JnC', '2025-03-14 15:29:10'),
(75, 'ercylie0@gmail.com', 'ercylie', 'cordero', 'f92b8df0c2febfa2935d681b625aa7f9e4ea809f58ca56b324a036e892ab7e87', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$SxQbw4zvEDBpIpooYgi/UOsrJKtmu2xLlExMjvd6aAdTTI4f8queG', '2025-03-14 15:29:10'),
(76, 'jeyvihunter@gmail.com', 'John', 'Doe', NULL, NULL, '1970-01-01', 'MALE', '09123456789', 'yes', 'Developer', '123asd', '1234', 'Santa Elena', 'Davao City', '$2y$10$B/LKcLoEAqhav.zEAOIpletsFm/RC4RY23URGTlFOZbJ.E3Bmbf8q', '2025-03-14 15:29:10'),
(77, 'pussieeecat70@gmail.com', 'cristiandave', 'protacio', '64979b695ea4924ace3adff3395d6b72547f228b3e9a4a3d0197ef86bd13b858', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$jjnJ7aGDvHW3gedTCaDXXOkvS8Fu5cguawwgpNLuBt3SjcdbibE4e', '2025-03-14 15:29:10'),
(78, 'sottoxzxz@gmail.com', 'loren', 'sotto', '18c68a7d199e03cd3f0cdadbbdb5288cebfb9f4863371756a55ca4514dc0e34c', NULL, '2002-10-19', 'OTHER', '09123456789', 'no', 'Student', 'Blk3 Lot 36', 'Dahlia', 'Old Capitol', 'Quezon City', '$2y$10$srJ.EFejo/.JijliskoXUu8LYSffNgl6zwuN3NMVGQOOuBO2dtn5a', '2025-03-14 15:29:10'),
(79, 'intern.josevener@gmail.com', 'Hunter', 'Hunter', 'f4487177a4b3c1ad67c24f043797c0da484bffb23532beef73cae4fe280ce1bd', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$Fa9AVkHrVtbIFFDbEtv1A.qPYkg6IrPLNHopNQuqAo3q7lkojCGba', '2025-03-14 15:29:10'),
(80, 'dschroederq33@gmail.com', 'NyvkpDapMlL', 'ctxiPXRP', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$UFUyU.z7.gixiwBVXQEzBeAHzGMAd5FVWJ.7lGHDW2nzdqe2feUEy', '2025-03-14 15:29:10'),
(81, 'macefelixerp@gmail.com', 'Ace Felixerp', 'Manganfjan', 'd57ffcdf92df8d78e13c93ad2f5139e43705fd4a7ac6336cc5da7f0768b4d0c4', NULL, '1970-01-01', 'MALE', '09123456789', 'yes', 'gantso', '1', 'Ewan ko', 'Tibay', 'Quezon Ciry', '$2y$10$fuwYDPVKiwZl7IvuRu2.DO1qG8iyuNzKPVEHUmq5ZU5JNoHsXFPom', '2025-03-14 15:29:10'),
(82, 'aigooiyang@gmail.com', 'Ma Christina', 'Baylon', NULL, NULL, '1970-01-01', 'MALE', '09637762627', 'yes', 'Service Crew', '23', 'KALINISAN', 'Batasan Hills', 'quezon city', '$2y$10$bYU7e76fvJZsutzEcOv5OeZhqwjjC0LfmZquC.UuKe3CZE1ZfEo5O', '2025-03-14 15:29:10'),
(83, 'tffnyshnbls@gmail.com', 'Tiffany', 'Shane', 'dd598f6fc8a08ec8d7d5c2e2d7b587ad9939bd06a23aa757d85258c5b9fc19fb', NULL, '1970-01-01', 'MALE', '09959798099', 'yes', 'student', '788', 'st', 'san mateo', 'quezon city', '$2y$10$YrTRH2XQ4AYhluZLx007rOX.dBrhIMQ4WTqx0o5nCRgyiI3CHc7W6', '2025-03-14 15:29:10'),
(84, 'kylejastinea@gmail.com', 'Kyle Jastine', 'Arroyo', '401c4e6a57d30d318c09b3fbb76cf9daa6e6c0aa8d10bb19d106208fc2b62dcd', NULL, '2003-05-02', 'MALE', '09205367491', 'yes', 'none', '100 Old Samson Road', '100 A Old samson', 'Apolonio Samson', 'Quezon City', '$2y$10$tICo9OKvyTf5if6bIcExCu9gBkReM9b10.J4oncQ9W8pnFeG/C/Ma', '2025-03-14 15:29:10'),
(85, 'clerigodiel@gmail.com', 'diel', 'clerigo', '88baf10c29c3ed1d07948f659c3f6494a2a167033c441fcc975d5696f198a0c8', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$BGmw/mMV3y5BFDwWIkMf9.DaCGfttjQdxzSRfO6hhS1KocJdxmgEC', '2025-03-14 15:29:10'),
(86, 'imjerelyn01@gmail.com', 'Je', 'Gargoles', '79952428693a07b548fe799b79cbebb3a515e112035bb46a0bd95301a3751b48', NULL, '1970-01-01', 'FEMALE', '09123456789', 'yes', 'Cashier', '12', 'Nenita', 'Gulod', 'Quezon City', '$2y$10$U0xJyT7KsL/DYVFgZdqaKuWRA0kZCmQa2kEmTHsK1R5BYGR238pay', '2025-03-14 15:29:10'),
(87, 'wnupjvti9ws2t@yahoo.com', 'yvmkGrMdUvTvM', 'lbiuonSLvapCXkC', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$xicUPW4AER8QM.bx9rrTTesgObuJec8Q7tNzPwPDPkWMCigwYFgIK', '2025-03-14 15:29:10'),
(88, 'abesamisaj8@gmail.com', 'Andrei', 'Abesamis', NULL, NULL, '1970-01-01', 'MALE', '09157037101', 'no', 'student', '110', 'Dahlia street', 'philcoa', 'QUEZON CITY', '$2y$10$O.K96A5CXRJX/74P83y5E.hRuZSE8CJgh03N4bWbfEXjxpOTg3Sjm', '2025-03-14 15:29:10'),
(89, 'joshuarecto37@gmail.com', 'bekbek', 'neneng', NULL, NULL, '1970-01-01', 'MALE', '09123445523', 'yes', 'taga kulekta', 'kahit saan di mapupuntahan banda dito', 'sa kaliwa', 'namek', 'Quezon City', '$2y$10$dMblOobkk9rY4NHGu/05q.L2GDOjTJ1/UZKYgc.uwRAc9J/SU4w7K', '2025-03-14 15:29:10'),
(90, 'figak41947@dmener.com', 'bekbek', 'bebeng', NULL, NULL, '1970-02-10', 'MALE', '12345678901', 'yes', 'qwqweqwe', 'qweweqwe', 'qweqwe', 'qweqwewe', 'qweqweqwe', '$2y$10$KGBGLWWD07.mRWBVTJ06IeOYyb61krib/ahToVWrpujjBvps4bjIa', '2025-03-14 15:29:10'),
(91, 'maybeiknowthisi@gmail.com', 'holy', 'tester', '64194da8f962373a9c620eefe8fecdf8ebb72b4b8112803c5ad34a6a3a81113e', NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$YFA9fvD3zJeggzNuf61unOE6u9xmeD1Qb77PP/rcGTHztwWeudVoG', '2025-03-14 15:29:10'),
(92, 'ejubalde09@gmail.com', 'Ej', 'Ubalde', NULL, NULL, '1970-01-01', 'MALE', NULL, 'yes', NULL, NULL, NULL, NULL, NULL, '$2y$10$NwTp7VThmAAQYYvWUctLOOJGh78FXVLaABrMwNJ9KR1sDwCEDNtN6', '2025-03-14 15:29:10'),
(93, 'barretezia@gmail.com', 'zia', 'barrete', '02c7aa4d9d9c3ab2b91df11022fa869b2b7af790d4ef896efbf26938df27382d', NULL, '1970-01-01', 'MALE', '09930528713', 'yes', 'student', '13', 'street', 'tandang sora', 'quezon city', '$2y$10$GzHd0BEcbZ/UKnZpZKaQ/eNUhQAHWZPdlhbRDy3Mx.BW3ePtb3snG', '2025-03-14 15:29:10'),
(94, 'delrosariomjay26@gmail.com', 'Mjay', 'Del Rosario', 'a949c5c5250c6c2964b8daa1fd8ff3c0440cc6ee7a1f2e61f6a6e8776ca539d8', NULL, '2002-08-26', 'MALE', '09566496726', 'no', 'Na', '615', 'Na', '175', 'Caloocan', '$2y$10$qMdB63sUCRJeOsav1mzXsOW/hQucmGOXGf/Qd2WrrgHX3sumfB0fW', '2025-03-14 15:29:10'),
(95, 'kelvin.ggbet@gmail.com', 'Admin', 'Admin', 'e0f7d5c0b866b435770fb10b56ac0a9e92c8d9a1ec94d3e79a2085683e0298b0', NULL, '1970-01-01', 'FEMALE', '09637762627', 'yes', 'Service Crew', '23', 'KALINISAN', 'Santa Monica', 'quezon city', '$2y$10$FVz7PuzC7X9oE..XbHlI9uPSM0wZ6d1GhZQrJU8IfDJ8HqjXpKvCO', '2025-03-14 15:29:10'),
(96, 'janedoe@gmail.com', 'Jane', 'Doe', '34b7f1d0f97b4f0a561ece164f1580cc2aa2111251ed6b3df91efe652f4c66b8', NULL, '2002-01-01', 'FEMALE', '09123456789', 'yes', 'Gengineer', '69', 'Sixty Nine', 'Brgy Tibay', 'WE', '$2y$10$lW4GNgqV4anQEvrMnH4ha.Abbg1qZlqTka82gO/x7/f2493IaCRHe', '2025-03-14 15:29:10'),
(97, 'richardtabemmasculino@gmail.com', 'richard', 'masculino', 'e382135ee7d23d4d6720f72c144999ffacac58baad1556b1227319910805309b', NULL, '1970-01-01', 'MALE', '09202694071', 'no', 'student', '175', 'Jacinto st pagasa camarin', '175', 'Caloocan', '$2y$10$cJZOkkyu25il5/.juNo6DOCVsIgJBea0Y.kOH1CRHoeM02/V/g7.y', '2025-03-14 15:29:10');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_evaluation`
--

INSERT INTO `student_evaluation` (`id`, `student_id`, `evaluation_period`, `gross_motor_score`, `fine_motor_score`, `self_help_score`, `receptive_language_score`, `expressive_language_score`, `cognitive_score`, `socio_emotional_score`, `date_created`) VALUES
(8, 30, '1st', 2, 2, 3, 3, 4, 5, 5, '2025-03-14 04:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `middle_name`, `birthday`, `address`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', NULL, NULL, NULL, 'john@gmail.com', '$2y$10$g9Ry9GFsiL0CZGc.cj7/TehncUh6I/fWUX97o7OG7JJI5IhI2/9yu', 'teacher', '2025-03-13 07:19:38', '2025-03-13 07:19:38'),
(5, 'Casey', 'White', NULL, NULL, NULL, 'casey@gmail.com', '$2y$10$0e0I5.C4i.g4S3FKQEEBCumjGfKIvegIQeKSVCm5m57aOcSO8vhDi', 'guardian', '2025-03-13 11:22:09', '2025-03-13 11:22:59'),
(6, 'Sam', 'Taylor', NULL, NULL, NULL, 'sam@gmail.com', '$2y$10$XRPk/1lQ.mXwZeCjSRwH.OQRuHh4.OgU5ubGlb6QwhMUL4vMRaXy6', 'teacher', '2025-03-13 11:24:07', '2025-03-13 11:24:33'),
(7, 'michael', 'juan', NULL, NULL, NULL, 'test@gmail.com', '$2y$10$ymhLVeRgnynaMKY8btqqSuSKfu02C5Gq4bwGkR1z8yDXY8xSU/doC', 'teacher', '2025-03-13 18:23:09', '2025-03-13 18:53:50'),
(8, 'charles', 'lance', NULL, NULL, NULL, 'lancegula05@gmail.com', '$2y$10$IEK.nXxEAOBUG6732L38auUf7dN2A280LGRZ.5DsvoF9NZCDBLbcu', 'teacher', '2025-03-14 03:59:26', '2025-03-14 03:59:26');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `session_token` (`session_token`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registerlanding`
--
ALTER TABLE `registerlanding`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
