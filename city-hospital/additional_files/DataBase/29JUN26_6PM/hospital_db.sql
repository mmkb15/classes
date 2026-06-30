-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2026 at 02:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `admit_date` date NOT NULL,
  `discharge_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Admitted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `patient_id`, `room_id`, `admit_date`, `discharge_date`, `status`) VALUES
(1, 16, 3, '2026-06-27', NULL, 'Admitted'),
(3, 8, 4, '2026-06-27', '2026-06-28', 'Discharged'),
(4, 8, 1, '2026-06-29', NULL, 'Admitted'),
(5, 26, 2, '2026-06-28', NULL, 'Admitted'),
(6, 15, 4, '2026-06-28', '2026-06-28', 'Discharged'),
(7, 16, 4, '2026-06-28', NULL, 'Admitted'),
(8, 15, 13, '2026-06-28', NULL, 'Admitted');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `status` varchar(20) DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `status`, `created_at`) VALUES
(4, 14, 1, '2026-06-21', 'Completed', '2026-06-20 04:38:55'),
(5, 16, 2, '2026-06-13', 'Scheduled', '2026-06-20 05:50:02'),
(8, 8, 14, '2026-06-20', 'Completed', '2026-06-20 14:00:41'),
(9, 15, 31, '2026-06-21', 'Cancelled', '2026-06-20 14:11:59'),
(12, 26, 33, '2026-06-22', 'Scheduled', '2026-06-21 08:41:54'),
(13, 25, 32, '2026-07-02', 'Scheduled', '2026-06-25 18:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `admission_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `bill_date` date NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`id`, `patient_id`, `admission_id`, `amount`, `bill_date`, `description`) VALUES
(5, 8, 3, 15581.50, '2026-06-27', 'paid'),
(7, 8, 4, 14556.00, '2026-06-28', ''),
(9, 16, 7, 4000.00, '2026-06-29', '');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Cardiology', 'Heart related diseases', '2026-06-18 15:52:17'),
(2, 'Neurology', 'Brain and nervous system', '2026-06-18 15:52:17'),
(3, 'Orthopedics', 'Bone, joint, and muscle care and surgeries', '2026-06-19 17:55:36'),
(4, 'Gastroenterology', 'Digestive system, liver, and stomach disorders', '2026-06-20 14:07:22'),
(5, 'Urology', 'Urinary tract and male reproductive system', '2026-06-20 14:07:22'),
(6, 'Dermatology', 'Skin, hair, and nail treatments', '2026-06-20 14:07:22'),
(7, 'Pediatrics', 'Infant, child, and adolescent healthcare', '2026-06-20 14:07:22'),
(8, 'Gynecology & Obstetrics', 'Women health, pregnancy, and childbirth', '2026-06-20 14:07:22'),
(9, 'Nephrology', 'Kidney diseases and dialysis management', '2026-06-20 14:07:22'),
(10, 'Ophthalmology', 'Eye care, vision testing, and surgeries', '2026-06-20 14:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `dept_id`, `name`, `specialization`, `phone`, `email`, `created_at`, `image`) VALUES
(1, 1, 'Dr. Shahidul Rahman', 'Cardiologist', '01711111111', 'dr.rahman@hospital.com', '2026-06-18 15:52:17', 'doctor_1782723898.jpg'),
(2, 2, 'Dr. Nazma Akhtar', 'Neurologist', '01722222222', 'dr.akhtar@hospital.com', '2026-06-18 15:52:17', 'doctor_1782723876.png'),
(14, 3, 'Dr. Nasrin Akter', 'Orthopedic Surgeon ', '01922225555', 'dr.nasrin@gmail.com', '2026-06-19 17:56:50', 'doctor_1782723864.png'),
(25, 1, 'Prof. Dr. Shams Munwar', 'Interventional Cardiologist', '01711223344', 'shams.munwar@hms.com', '2026-06-20 14:10:23', 'doctor_1782724205.png'),
(26, 2, 'Prof. Dr. Deen Mohammad', 'Neurologist & Stroke Specialist', '01811223344', 'deen.mohammad@hms.com', '2026-06-20 14:10:23', 'doctor_1782723840.png'),
(27, 8, 'Dr. Lotifa L. Chowdhury', 'Gastroenterologist & Hepatologist', '01911223344', 'lutful.chowdhury@hms.com', '2026-06-20 14:10:23', 'doctor_1782724146.png'),
(28, 3, 'Prof. Dr. M. Amjad Hossain', 'Orthopedic & Arthroplasty Surgeon', '01511223344', 'amjad.hossain@hms.com', '2026-06-20 14:10:23', 'doctor_1782723924.jpg'),
(29, 5, 'Prof. Dr. Mohammad Abdus Salam', 'Urologist & Kidney Transplant Specialist', '01611223344', 'abdus.salam@hms.com', '2026-06-20 14:10:23', 'doctor_1782723795.png'),
(30, 8, 'Dr. Jasmine Manzoor', 'Gynecologist & Infertility Specialist', '01722334455', 'jasmine.manzoor@hms.com', '2026-06-20 14:10:23', 'doctor_1782723779.png'),
(31, 1, 'Prof. Dr. Abid Hossain Mollah', 'Pediatrician & Child Specialist', '01822334455', 'abid.mollah@hms.com', '2026-06-20 14:10:23', 'doctor_1782723764.png'),
(32, 6, 'Prof. Dr. T. A. Chowdhury', 'Clinical & Aesthetic Dermatologist', '01922334455', 'ta.chowdhury@hms.com', '2026-06-20 14:10:23', 'doctor_1782723753.png'),
(33, 9, 'Prof. Dr. Muhibur Rahman', 'Nephrologist & Kidney Specialist', '01522334455', 'muhibur.rahman@hms.com', '2026-06-20 14:10:23', 'doctor_1782723742.png'),
(34, 3, 'Prof. Dr. Ava Hossain', 'Ophthalmologist & Phaco Surgeon', '01622334455', 'ava.hossain@hms.com', '2026-06-20 14:10:23', 'doctor_1782721087.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`) VALUES
(2, 'Female'),
(1, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `strength` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `strength`, `price`, `created_at`) VALUES
(6, 'Napa Extend', '665 mg', 2.50, '2026-06-20 14:21:22'),
(7, 'Seclo', '20 mg', 7.00, '2026-06-20 14:21:22'),
(8, 'Sergel', '20 mg', 8.00, '2026-06-20 14:21:22'),
(9, 'Alatrol', '10 mg', 4.00, '2026-06-20 14:21:22'),
(10, 'Zimax', '500 mg', 45.00, '2026-06-20 14:21:22'),
(11, 'Ace', '500 mg', 1.50, '2026-06-20 14:21:22'),
(12, 'Fenadin', '120 mg', 9.00, '2026-06-20 14:21:22'),
(13, 'Monas', '10 mg', 17.50, '2026-06-20 14:21:22'),
(14, 'Bizoran', '5/20 mg', 12.00, '2026-06-20 14:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `age`, `phone`, `address`, `created_at`, `gender_id`, `image`) VALUES
(8, 'Asia Rahman', 33, '01777777777', 'TCLK, Paltan, Dhaka', '2026-06-19 10:26:16', 2, 'patient_1782730639.png'),
(14, 'Mustafa Mursalin', 31, '01677887778', 'Mirpur, Dhaka', '2026-06-19 14:47:47', 1, 'patient_1782719781.jpg'),
(15, 'Hridoy', 28, '01922225555', 'Mohakhali, Dhaka', '2026-06-19 15:05:21', 1, 'patient_1782723539.png'),
(16, 'Shahed Ahmed Rion', 27, '01955555555', 'Bijoy Shoroni, Dhaka', '2026-06-19 15:46:33', 1, 'patient_1782730809.png'),
(18, 'Masum Billah', 27, '01399999999', 'Uttora, Dhaka', '2026-06-19 16:37:16', 1, 'patient_1782721024.jpg'),
(20, 'Jaber Hossain', 28, '01822223334', 'Motijheel, Dhaka', '2026-06-19 16:58:12', 1, 'patient_1782723712.jpg'),
(22, 'Faysal Hossen', 27, '01676667777', 'Jatra Bari, Dhaka', '2026-06-20 13:54:39', 1, 'patient_1782731249.png'),
(23, 'MD. ARIF HUSHAIN MUNNA', 28, '01999993333', 'Sadar Ghat, Dhaka\r\n', '2026-06-20 13:56:01', 1, 'patient_1782731261.png'),
(24, 'MD. SAKIRUL HAQ', 28, '01666600888', 'Malibag, Dhaka', '2026-06-20 13:57:00', 1, 'patient_1782731233.png'),
(25, 'Ruksana Nourin', 26, '01388765555', 'Mirpur 2, Dhaka', '2026-06-20 13:57:50', 2, 'patient_1782731279.png'),
(26, 'Md Khairul Islam Eimrul', 28, '01899943334', 'Nilkhet, Dhaka', '2026-06-20 13:59:34', 1, 'patient_1782723684.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `diagnosis` text DEFAULT NULL,
  `prescription_date` date NOT NULL,
  `follow_up_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `appointment_id`, `patient_id`, `doctor_id`, `diagnosis`, `prescription_date`, `follow_up_date`, `notes`, `created_at`) VALUES
(5, 4, 14, 2, 'Patient presents with fever, headache, and body ache for the last 3 days. Clinical findings suggest Acute Viral Fever. CBC test advised for further evaluation.\r\n\r\nNotes :\r\nTake adequate rest and drink plenty of fluids. Complete the prescribed medication course. Return immediately if fever persists for more than 5 days or symptoms worsen.', '2026-06-20', '2026-06-21', 'Don\'t Be Tense', '2026-06-20 06:14:10'),
(6, 8, 8, 14, 'Aisa Rahman, a female patient, presented with symptoms including generalized body pain, fatigue, muscle weakness, and bone pain for the past few weeks.\r\n\r\nClinical Findings :\r\n\r\nLow Vitamin D levels confirmed through laboratory investigation\r\nGeneralized musculoskeletal pain\r\nFatigue and weakness\r\n\r\nDiagnosis:\r\n\r\nVitamin D Deficiency (ICD-10: E55.9)\r\nVitamin D Deficiency related myalgia and fatigue\r\n\r\nRecommendations:\r\n\r\nVitamin D3 supplementation (as per advised dosage)\r\nCalcium-rich diet and adequate sun exposure\r\nRegular physical activity and weight-bearing exercises\r\nFollow-up Vitamin D level test after 8-12 weeks', '2026-06-20', '2026-06-27', 'Patient diagnosed with Vitamin D deficiency. Advised Vitamin D supplementation, calcium-rich diet, and sunlight exposure. Follow up with repeat Vitamin D level test. Take medicine regularly.', '2026-06-20 14:37:06'),
(10, 8, 8, 2, 'N/A', '2026-06-28', '2026-07-01', 'N/A', '2026-06-28 11:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicines`
--

CREATE TABLE `prescription_medicines` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_medicines`
--

INSERT INTO `prescription_medicines` (`id`, `prescription_id`, `medicine_id`, `dosage`, `duration`, `instructions`) VALUES
(5, 6, 10, '1 tablet once daily', '30 days', 'Take after meal with water. Avoid taking with dairy products.'),
(6, 6, 11, '1 + 0 + 1', '7 days', 'Take after meals with water. For pain relief.'),
(7, 6, 14, '1 tablet once daily', '30 days', 'Take at the same time every day. For blood pressure control.'),
(8, 6, 6, '0+ 1 + 0', '10 days', 'Take after food. For pain and fever.'),
(10, 6, 10, '0+ 0 + 1', '5 days', 'Take 1 hour before or 2 hours after meal. Antibiotic - complete full course.'),
(11, 6, 13, '1 + 0 + 0', '30 days', 'Take at bedtime. For allergy or breathing issues.'),
(12, 6, 8, '1 tablet once daily', '14 days', 'Take 30 minutes before breakfast. For acidity.'),
(18, 10, 7, '1 +0 +1', '4 Days', 'N/A'),
(19, 10, 13, '1 +0 +1', '3 Days', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_tests`
--

CREATE TABLE `prescription_tests` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_tests`
--

INSERT INTO `prescription_tests` (`id`, `prescription_id`, `test_id`, `instructions`) VALUES
(5, 6, 6, 'Fasting not required. Done to check for anemia or infection.'),
(6, 6, 7, '8-12 hours fasting required. To assess cholesterol levels.'),
(8, 6, 6, 'Fasting not required. Done to check for anemia or infection.'),
(9, 6, 12, 'No special preparation. To evaluate heart function.'),
(10, 6, 13, '8-10 hours fasting required. Morning sample preferred.'),
(13, 6, 15, 'No special preparation unless contrast is used.'),
(14, 6, 8, 'No fasting required. To check kidney function.'),
(15, 6, 9, 'Full bladder required. 6-8 hours fasting preferred.'),
(17, 6, 10, 'No special preparation. Stand straight during the procedure.'),
(22, 10, 6, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_no` varchar(20) NOT NULL,
  `room_type` varchar(50) DEFAULT 'General',
  `status` varchar(20) DEFAULT 'Available',
  `rate_per_day` decimal(10,2) DEFAULT 500.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `room_type`, `status`, `rate_per_day`) VALUES
(1, '101', 'General', 'Occupied', 500.00),
(2, '102', 'General', 'Occupied', 500.00),
(3, '201', 'Cabin', 'Occupied', 1000.00),
(4, '202', 'ICU', 'Available', 2000.00),
(5, '103', 'General', 'Available', 500.00),
(6, '104', 'General', 'Occupied', 500.00),
(7, '105', 'General', 'Available', 500.00),
(8, '203', 'Cabin', 'Available', 1000.00),
(9, '204', 'Cabin', 'Occupied', 1000.00),
(10, '205', 'Cabin', 'Maintenance', 1000.00),
(11, '301', 'ICU', 'Occupied', 2000.00),
(12, '302', 'ICU', 'Available', 2000.00),
(13, '303', 'ICU', 'Occupied', 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`, `description`, `price`, `created_at`) VALUES
(6, 'CBC (Complete Blood Count)', 'Routine blood test to evaluate overall health and detect disorders like anemia.', 450.00, '2026-06-20 14:23:24'),
(7, 'Lipid Profile', 'A panel of blood tests used to find risks of cardiovascular diseases.', 1200.00, '2026-06-20 14:23:24'),
(8, 'Serum Creatinine', 'Kidney function test to measure the level of creatinine in the blood.', 400.00, '2026-06-20 14:23:24'),
(9, 'Ultrasonography (USG) of Whole Abdomen', 'Imaging test to examine organs in the abdomen like liver, kidneys, and gallbladder.', 1800.00, '2026-06-20 14:23:24'),
(10, 'X-Ray Chest P/A View', 'Standard chest X-ray to diagnose lung diseases or heart structures.', 500.00, '2026-06-20 14:23:24'),
(11, 'ECG (Electrocardiogram)', 'Test to record the electrical activity of the heart over a period of time.', 400.00, '2026-06-20 14:23:24'),
(12, 'Echocardiogram', 'Ultrasound of the heart to see real-time motion and valve functions.', 2500.00, '2026-06-20 14:23:24'),
(13, 'Fasting Blood Sugar (FBS)', 'Blood test to measure glucose levels after fasting, used to detect diabetes.', 150.00, '2026-06-20 14:23:24'),
(15, 'MRI of Brain', 'Advanced imaging to detect tumors, strokes, or neurological issues in brain.', 6000.00, '2026-06-20 14:23:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `admission_id` (`admission_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_id` (`prescription_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_id` (`prescription_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `admissions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admissions_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `billings`
--
ALTER TABLE `billings`
  ADD CONSTRAINT `billings_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `billings_ibfk_2` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_ibfk_3` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  ADD CONSTRAINT `prescription_medicines_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_medicines_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  ADD CONSTRAINT `prescription_tests_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
