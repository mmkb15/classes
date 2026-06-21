CREATE TABLE `departments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100),
  `description` text,
  `created_at` timestamp
);

CREATE TABLE `patients` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100),
  `age` int,
  `gender` varchar(10),
  `phone` varchar(20),
  `address` text,
  `created_at` timestamp
);

CREATE TABLE `rooms` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `room_no` varchar(20),
  `room_type` varchar(50),
  `status` varchar(20)
);

CREATE TABLE `doctors` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `dept_id` int,
  `name` varchar(100),
  `specialization` varchar(100),
  `phone` varchar(20),
  `email` varchar(100),
  `created_at` timestamp
);

CREATE TABLE `admissions` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `patient_id` int,
  `room_id` int,
  `admit_date` date,
  `discharge_date` date,
  `status` varchar(20)
);

CREATE TABLE `appointments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `patient_id` int,
  `doctor_id` int,
  `appointment_date` date,
  `status` varchar(20),
  `created_at` timestamp
);

CREATE TABLE `billings` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `patient_id` int,
  `admission_id` int,
  `amount` decimal(10,2),
  `bill_date` date,
  `description` text
);

ALTER TABLE `doctors` ADD FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`);

ALTER TABLE `admissions` ADD FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

ALTER TABLE `admissions` ADD FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

ALTER TABLE `appointments` ADD FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

ALTER TABLE `appointments` ADD FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

ALTER TABLE `billings` ADD FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

ALTER TABLE `billings` ADD FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`);
