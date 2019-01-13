-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 13, 2019 at 06:40 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_website` varchar(256) DEFAULT NULL,
  `company_email` varchar(256) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `company_logo` varchar(250) DEFAULT NULL,
  `company_address` varchar(300) DEFAULT NULL,
  `company_type` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_website`, `company_email`, `contact_number`, `company_logo`, `company_address`, `company_type`, `status`, `created_date`) VALUES
(1, 'Google', 'https://google.com', 'info@google.com', '9658374321', 'image/company/1.jpg', 'California, US', 'Information Technology', 1, '2019-01-12 23:23:48'),
(2, 'Skills Hat', 'https://skillshat.com', 'skills@gmail.com', '011234567', NULL, NULL, '', 0, '2019-01-13 08:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `stipend` varchar(50) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `profile` varchar(200) DEFAULT NULL,
  `skills` varchar(200) NOT NULL,
  `nature` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `no_of_seats` int(11) DEFAULT NULL,
  `linkedin_id` varchar(100) DEFAULT NULL,
  `contact_email` varchar(256) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `interview_date` date DEFAULT NULL,
  `eligibility` varchar(3000) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `title`, `slug`, `address`, `start_date`, `last_date`, `duration`, `stipend`, `description`, `profile`, `skills`, `nature`, `city`, `no_of_seats`, `linkedin_id`, `contact_email`, `contact_number`, `interview_date`, `eligibility`, `added_by`, `status`, `added_date`) VALUES
(1, 'Python Developer', 'python-developer', 'Cannaught Place', '2019-01-14', '2019-01-16', '1', '120000, 199982', ' description', 'Python Developer', 'python,java', 'Full Time', 'New Delhi', 4, 'LinkedIn12', 'info@google.com', '9658374321', '2019-01-16', 'eligibility', 2, 0, '2019-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `profile` varchar(200) NOT NULL,
  `industry_type` varchar(50) NOT NULL,
  `nature` varchar(100) NOT NULL,
  `skills` varchar(300) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `paid` varchar(10) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `linkedin_id` varchar(50) NOT NULL,
  `contact_email` varchar(256) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `interview_date` date NOT NULL,
  `description` varchar(5000) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `slug`, `profile`, `industry_type`, `nature`, `skills`, `qualification`, `experience`, `address`, `city`, `paid`, `salary`, `linkedin_id`, `contact_email`, `contact_number`, `interview_date`, `description`, `added_by`, `status`, `added_date`) VALUES
(1, 'Python Developer', 'python-developer', 'Python Developer', 'IT', 'Full Time', 'Python, Django, Numpy, Pandas', 'B.Tech', '0 Year, 3 Year', 'Cannaught Place', 'New Delhi', 'Y', '120000, 200000', 'LinkedIn12', 'info@google.com', ' 9658374321', '2019-01-10', 'description', 2, 1, '2019-01-13 08:53:24'),
(2, 'Android Developer', 'android-developer', 'Android Developer', 'IT', 'Full Time', 'Java, Android Studio', 'B.Tech', '0 Year, 3 Year', 'Cannaught Place', 'New Delhi', 'Y', '120000, 200000', 'LinkedIn12', 'info@skills.com', ' 9658374321', '2019-01-10', 'description', 1, 1, '2019-01-13 08:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(200) DEFAULT NULL,
  `student_email` varchar(256) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `qualification` varchar(250) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_email`, `contact_number`, `city`, `qualification`, `experience`, `status`, `created_date`) VALUES
(1, 'ShyamBabu', 'shyam@gmail.com', '9876578941', 'New Delhi', 'Diploma', '6 Months', 1, '2019-01-13 06:23:01'),
(2, 'Ashwani', 'ashwani@gmail.com', '9898646765', NULL, NULL, NULL, 0, '2019-01-13 08:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_type`, `company_id`, `candidate_id`, `status`, `hash`) VALUES
(1, 'google', 'info@google.com', 'google', 4, 1, 0, 1, 'fdsve434wfv4343wfe54234w'),
(2, 'shyam', 'shyam@gmail.com', 'shyam', 5, 0, 1, 1, 'fdsve434wfv4343wfe54234w'),
(3, NULL, 'ashwani@gmail.com', 'ashwani', 5, NULL, 2, 0, 'be75f1b3b924295b06dafaf3ccd76c29d2d915e8c01adc8b38349dfce627a9b6'),
(4, NULL, 'skills@gmail.com', 'shyam', 4, 2, NULL, 0, 'ab589d82a22f45f38742c096b44525ca95d0e8777b3cecf9a2224dc341b206ec');

-- --------------------------------------------------------

--
-- Table structure for table `user_internship_applied`
--

CREATE TABLE `user_internship_applied` (
  `id` int(11) NOT NULL,
  `internship_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pending` int(11) NOT NULL DEFAULT '1',
  `shortlist` int(11) NOT NULL DEFAULT '0',
  `selected` int(11) NOT NULL DEFAULT '0',
  `rejected` int(11) NOT NULL DEFAULT '0',
  `applied_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_internship_applied`
--

INSERT INTO `user_internship_applied` (`id`, `internship_id`, `user_id`, `pending`, `shortlist`, `selected`, `rejected`, `applied_date`) VALUES
(1, 1, 1, 1, 0, 0, 0, '2019-01-02 00:00:00'),
(2, 2, 1, 1, 0, 0, 0, '2019-01-13 06:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_jobs_applied`
--

CREATE TABLE `user_jobs_applied` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pending` int(11) NOT NULL DEFAULT '1',
  `shortlist` int(11) NOT NULL DEFAULT '0',
  `selected` int(11) NOT NULL DEFAULT '0',
  `rejected` int(11) NOT NULL DEFAULT '0',
  `applied_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_jobs_applied`
--

INSERT INTO `user_jobs_applied` (`id`, `job_id`, `user_id`, `pending`, `shortlist`, `selected`, `rejected`, `applied_date`) VALUES
(1, 1, 1, 0, 1, 0, 0, '2019-01-02 00:00:00'),
(2, 1, 1, 1, 0, 0, 0, '2019-01-13 06:22:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_internship_applied`
--
ALTER TABLE `user_internship_applied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_jobs_applied`
--
ALTER TABLE `user_jobs_applied`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_internship_applied`
--
ALTER TABLE `user_internship_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_jobs_applied`
--
ALTER TABLE `user_jobs_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
