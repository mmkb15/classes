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
INSERT INTO medicines (name, strength, price) VALUES
('Paracetamol', '500mg', 50.00),
('Amoxicillin', '250mg', 120.00),
('Omeprazole', '20mg', 80.00),
('Cetirizine', '10mg', 30.00),
('Metformin', '500mg', 90.00);

INSERT INTO tests (name, description, price) VALUES
('CBC', 'Complete Blood Count', 500.00),
('Blood Sugar', 'Fasting Blood Sugar Test', 300.00),
('X-Ray', 'Chest X-Ray', 800.00),
('ECG', 'Electrocardiogram', 1000.00),
('MRI', 'Magnetic Resonance Imaging', 5000.00);