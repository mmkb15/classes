-- =============================================
-- STEP 1: Drop tables in reverse order (to avoid foreign key errors)
-- =============================================
DROP TABLE IF EXISTS billings;
DROP TABLE IF EXISTS appointments;
DROP TABLE IF EXISTS admissions;
DROP TABLE IF EXISTS doctors;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS patients;
DROP TABLE IF EXISTS departments;

-- =============================================
-- STEP 2: Create Parent Tables (No Foreign Keys)
-- =============================================

-- 1. Departments Table (Parent of Doctors)
CREATE TABLE departments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Patients Table (Parent of Appointments, Billings, Admissions)
CREATE TABLE patients (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT(3),
    gender VARCHAR(10),
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Rooms Table (Parent of Admissions)
CREATE TABLE rooms (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_no VARCHAR(20) NOT NULL,
    room_type VARCHAR(50) DEFAULT 'General',
    status VARCHAR(20) DEFAULT 'Available'
);

-- =============================================
-- STEP 3: Create Child Tables (With Foreign Keys)
-- =============================================

-- 4. Doctors Table (Child of Departments)
CREATE TABLE doctors (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    dept_id INT(11),
    name VARCHAR(100) NOT NULL,
    specialization VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (dept_id) REFERENCES departments(id) ON DELETE SET NULL
);

-- 5. Admissions Table (Child of Patients and Rooms)
CREATE TABLE admissions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    patient_id INT(11) NOT NULL,
    room_id INT(11) NOT NULL,
    admit_date DATE NOT NULL,
    discharge_date DATE NULL,
    status VARCHAR(20) DEFAULT 'Admitted',
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

-- 6. Appointments Table (Child of Patients and Doctors)
CREATE TABLE appointments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    patient_id INT(11) NOT NULL,
    doctor_id INT(11) NOT NULL,
    appointment_date DATE NOT NULL,
    status VARCHAR(20) DEFAULT 'Scheduled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

-- 7. Billings Table (Child of Patients and Admissions - Optional)
CREATE TABLE billings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    patient_id INT(11) NOT NULL,
    admission_id INT(11) NULL,
    amount DECIMAL(10,2) NOT NULL,
    bill_date DATE NOT NULL,
    description TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (admission_id) REFERENCES admissions(id) ON DELETE SET NULL
);















-- =========================================
-- Dummy Data
-- =========================================

-- =========================================
-- ১. Department এ ডেটা
-- =========================================
INSERT INTO departments (name, description) VALUES
('Cardiology', 'Heart related diseases'),
('Neurology', 'Brain and nervous system');

-- =========================================
-- ২. Doctors এ ডেটা (dept_id 1 বা 2)
-- =========================================
INSERT INTO doctors (dept_id, name, specialization, phone, email) VALUES
(1, 'Dr. Shahidul Rahman', 'Cardiologist', '01711111111', 'dr.rahman@hospital.com'),
(2, 'Dr. Nazma Akhtar', 'Neurologist', '01722222222', 'dr.akhtar@hospital.com');

-- =========================================
-- ৩. Patients এ ডেটা (রোগী)
-- =========================================
INSERT INTO patients (name, age, gender, phone, address) VALUES
('Md. Rahim Mia', 45, 'Male', '01911111111', 'Dhaka, Bangladesh'),
('Ms. Salma Khatun', 30, 'Female', '01922222222', 'Chittagong, Bangladesh'),
('Md. Kamal Hossain', 60, 'Male', '01933333333', 'Rajshahi, Bangladesh');

-- =========================================
-- ৪. Appointments এ ডেটা (অ্যাপয়েন্টমেন্ট)
-- =========================================
INSERT INTO appointments (patient_id, doctor_id, appointment_date, status) VALUES
(1, 1, '2026-06-18', 'Scheduled'),
(2, 2, '2026-06-19', 'Completed'),
(1, 2, '2026-06-20', 'Scheduled');

-- =========================================
-- ৫. Billings এ ডেটা (admission_id NULL রাখলাম, কারণ OPD বিল)
-- =========================================
INSERT INTO billings (patient_id, admission_id, amount, bill_date, description) VALUES
(1, NULL, 5000.00, '2026-06-18', 'OPD Consultation & ECG'),
(2, NULL, 12000.00, '2026-06-19', 'MRI Scan & Medicine'),
(3, NULL, 2500.00, '2026-06-17', 'General Checkup');




--================================================ Newly Added


-- =============================================
-- 1. MEDICINES TABLE
-- =============================================
CREATE TABLE medicines (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    strength VARCHAR(50),
    price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- 2. TESTS TABLE
-- =============================================
CREATE TABLE tests (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- 3. PRESCRIPTIONS TABLE (Main)
-- =============================================
CREATE TABLE prescriptions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    appointment_id INT(11) NOT NULL,
    patient_id INT(11) NOT NULL,
    doctor_id INT(11) NOT NULL,
    diagnosis TEXT,
    prescription_date DATE NOT NULL,
    follow_up_date DATE NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

-- =============================================
-- 4. PRESCRIPTION MEDICINES (Many-to-Many)
-- =============================================
CREATE TABLE prescription_medicines (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    prescription_id INT(11) NOT NULL,
    medicine_id INT(11) NOT NULL,
    dosage VARCHAR(50),
    duration VARCHAR(50),
    instructions TEXT,
    FOREIGN KEY (prescription_id) REFERENCES prescriptions(id) ON DELETE CASCADE,
    FOREIGN KEY (medicine_id) REFERENCES medicines(id) ON DELETE CASCADE
);

-- =============================================
-- 5. PRESCRIPTION TESTS (Many-to-Many)
-- =============================================
CREATE TABLE prescription_tests (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    prescription_id INT(11) NOT NULL,
    test_id INT(11) NOT NULL,
    instructions TEXT,
    FOREIGN KEY (prescription_id) REFERENCES prescriptions(id) ON DELETE CASCADE,
    FOREIGN KEY (test_id) REFERENCES tests(id) ON DELETE CASCADE
);

-- =============================================
-- INSERT SOME SAMPLE DATA
-- =============================================



INSERT INTO departments (id, name, description) VALUES
(4, 'Gastroenterology', 'Digestive system, liver, and stomach disorders'),
(5, 'Urology', 'Urinary tract and male reproductive system'),
(6, 'Dermatology', 'Skin, hair, and nail treatments'),
(7, 'Pediatrics', 'Infant, child, and adolescent healthcare'),
(8, 'Gynecology & Obstetrics', 'Women health, pregnancy, and childbirth'),
(9, 'Nephrology', 'Kidney diseases and dialysis management'),
(10, 'Ophthalmology', 'Eye care, vision testing, and surgeries');


INSERT INTO doctors (dept_id, name, specialization, phone, email) VALUES
(1, 'Prof. Dr. Shams Munwar', 'Interventional Cardiologist', '01711223344', 'shams.munwar@hms.com'),
(2, 'Prof. Dr. Deen Mohammad', 'Neurologist & Stroke Specialist', '01811223344', 'deen.mohammad@hms.com'),
(3, 'Dr. Lutful L. Chowdhury', 'Gastroenterologist & Hepatologist', '01911223344', 'lutful.chowdhury@hms.com'),
(4, 'Prof. Dr. M. Amjad Hossain', 'Orthopedic & Arthroplasty Surgeon', '01511223344', 'amjad.hossain@hms.com'),
(5, 'Prof. Dr. Mohammad Abdus Salam', 'Urologist & Kidney Transplant Specialist', '01611223344', 'abdus.salam@hms.com'),
(6, 'Dr. Jasmine Manzoor', 'Clinical & Aesthetic Dermatologist', '01722334455', 'jasmine.manzoor@hms.com'),
(7, 'Prof. Dr. Abid Hossain Mollah', 'Pediatrician & Child Specialist', '01822334455', 'abid.mollah@hms.com'),
(8, 'Prof. Dr. T. A. Chowdhury', 'Gynecologist & Infertility Specialist', '01922334455', 'ta.chowdhury@hms.com'),
(9, 'Prof. Dr. Muhibur Rahman', 'Nephrologist & Kidney Specialist', '01522334455', 'muhibur.rahman@hms.com'),
(10, 'Prof. Dr. Ava Hossain', 'Ophthalmologist & Phaco Surgeon', '01622334455', 'ava.hossain@hms.com');


INSERT INTO medicines (name, strength, price) VALUES
('Napa Extend', '665 mg', 2.50),
('Seclo', '20 mg', 7.00),
('Sergel', '20 mg', 8.00),
('Alatrol', '10 mg', 4.00),
('Zimax', '500 mg', 45.00),
('Ace', '500 mg', 1.50),
('Fenadin', '120 mg', 9.00),
('Monas', '10 mg', 17.50),
('Bizoran', '5/20 mg', 12.00),
('Xarelto', '10 mg', 75.00);



INSERT INTO tests (name, description, price) VALUES
('CBC (Complete Blood Count)', 'Routine blood test to evaluate overall health and detect disorders like anemia.', 450.00),
('Lipid Profile', 'A panel of blood tests used to find risks of cardiovascular diseases.', 1200.00),
('Serum Creatinine', 'Kidney function test to measure the level of creatinine in the blood.', 400.00),
('Ultrasonography (USG) of Whole Abdomen', 'Imaging test to examine organs in the abdomen like liver, kidneys, and gallbladder.', 1800.00),
('X-Ray Chest P/A View', 'Standard chest X-ray to diagnose lung diseases or heart structures.', 500.00),
('ECG (Electrocardiogram)', 'Test to record the electrical activity of the heart over a period of time.', 400.00),
('Echocardiogram', 'Ultrasound of the heart to see real-time motion and valve functions.', 2500.00),
('Fasting Blood Sugar (FBS)', 'Blood test to measure glucose levels after fasting, used to detect diabetes.', 150.00),
('HBA1c', 'Test that shows the average level of blood sugar over the past 2 to 3 months.', 800.00),
('MRI of Brain', 'Advanced imaging to detect tumors, strokes, or neurological issues in brain.', 6000.00);




INSERT INTO rooms (room_no, room_type, status) VALUES 
('101', 'General', 'Available'),
('102', 'General', 'Available'),
('201', 'Cabin', 'Available'),
('202', 'ICU', 'Available');

UPDATE rooms SET rate_per_day = 500.00 WHERE room_type = 'General';
UPDATE rooms SET rate_per_day = 1000.00 WHERE room_type = 'Cabin';
UPDATE rooms SET rate_per_day = 2000.00 WHERE room_type = 'ICU';

INSERT INTO rooms (room_no, room_type, status, rate_per_day) VALUES
('103', 'General', 'Available', 500.00),
('104', 'General', 'Occupied', 500.00),
('105', 'General', 'Available', 500.00),
('203', 'Cabin', 'Available', 1000.00),
('204', 'Cabin', 'Occupied', 1000.00),
('205', 'Cabin', 'Maintenance', 1000.00),
('301', 'ICU', 'Occupied', 2000.00),
('302', 'ICU', 'Available', 2000.00),
('303', 'ICU', 'Available', 2000.00);