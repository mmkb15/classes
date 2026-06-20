-- =============================================
-- Hospital Management System - Database
-- =============================================

CREATE DATABASE IF NOT EXISTS hospital_db;
USE hospital_db;

-- Users (Admin Login)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','staff') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Departments
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Doctors
CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialty VARCHAR(100),
    department_id INT,
    phone VARCHAR(15),
    email VARCHAR(100),
    status ENUM('Active','Inactive') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
);

-- Patients
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT,
    gender ENUM('Male','Female','Other'),
    phone VARCHAR(15),
    address TEXT,
    blood_group VARCHAR(5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Appointments
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME,
    status ENUM('Pending','Confirmed','Cancelled','Completed') DEFAULT 'Pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

-- =============================================
-- Sample Data
-- =============================================

INSERT INTO users (username, password, role) VALUES
('admin', MD5('admin123'), 'admin');

INSERT INTO departments (name) VALUES
('Cardiology'),
('Neurology'),
('Orthopedics'),
('Pediatrics'),
('General Medicine');

INSERT INTO doctors (name, specialty, department_id, phone, email) VALUES
('Dr. Rahim Uddin', 'Cardiologist', 1, '01711000001', 'rahim@hospital.com'),
('Dr. Karim Hossain', 'Neurologist', 2, '01711000002', 'karim@hospital.com'),
('Dr. Nasrin Akter', 'Orthopedic Surgeon', 3, '01711000003', 'nasrin@hospital.com'),
('Dr. Faruk Ahmed', 'Pediatrician', 4, '01711000004', 'faruk@hospital.com');

INSERT INTO patients (name, age, gender, phone, address, blood_group) VALUES
('Mohammad Ali', 45, 'Male', '01811000001', 'Dhaka, Bangladesh', 'A+'),
('Fatema Begum', 32, 'Female', '01811000002', 'Chittagong, Bangladesh', 'B+'),
('Rafiq Islam', 60, 'Male', '01811000003', 'Sylhet, Bangladesh', 'O+'),
('Sumaiya Khan', 28, 'Female', '01811000004', 'Rajshahi, Bangladesh', 'AB+');

INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status) VALUES
(1, 1, CURDATE(), '10:00:00', 'Confirmed'),
(2, 2, CURDATE(), '11:00:00', 'Pending'),
(3, 3, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '09:00:00', 'Confirmed'),
(4, 4, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '14:00:00', 'Pending');
