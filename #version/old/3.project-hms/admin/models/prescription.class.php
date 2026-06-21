<?php
class Prescription
{
    public $id;
    public $appointment_id;
    public $patient_id;
    public $doctor_id;
    public $diagnosis;
    public $prescription_date;
    public $follow_up_date;
    public $notes;

    public function __construct($_id, $_appointment_id, $_patient_id, $_doctor_id, $_diagnosis, $_prescription_date, $_follow_up_date = null, $_notes = null) {
        $this->id = $_id;
        $this->appointment_id = $_appointment_id;
        $this->patient_id = $_patient_id;
        $this->doctor_id = $_doctor_id;
        $this->diagnosis = $_diagnosis;
        $this->prescription_date = $_prescription_date;
        $this->follow_up_date = $_follow_up_date;
        $this->notes = $_notes;
    }

    // =============================================
    // CREATE - new prescription using Prepared Statement
    // =============================================
    public function create() {
        global $db;

        // Using Prepared Statement to prevent SQL injection and apostrophe issues
        $stmt = $db->prepare("INSERT INTO prescriptions (appointment_id, patient_id, doctor_id, diagnosis, prescription_date, follow_up_date, notes) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("iiissss", 
            $this->appointment_id, 
            $this->patient_id, 
            $this->doctor_id, 
            $this->diagnosis, 
            $this->prescription_date, 
            $this->follow_up_date, 
            $this->notes
        );

        $stmt->execute();
        $last_id = $stmt->insert_id;

        if ($stmt->error) {
            return $stmt->error;
        } else {
            return $last_id;
        }
    }

    // =============================================
    // READ ALL - with patient & doctor name
    // =============================================
    static public function readAll() {
        global $db;

        $sql = "SELECT p.*, 
                       pat.name AS patient_name, 
                       doc.name AS doctor_name 
                FROM prescriptions AS p
                LEFT JOIN patients AS pat ON p.patient_id = pat.id
                LEFT JOIN doctors AS doc ON p.doctor_id = doc.id
                ORDER BY p.id DESC";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // READ BY ID
    // =============================================
    static public function readByID($_id) {
        global $db;

        $sql = "SELECT p.*, 
                       pat.name AS patient_name, 
                       doc.name AS doctor_name 
                FROM prescriptions AS p
                LEFT JOIN patients AS pat ON p.patient_id = pat.id
                LEFT JOIN doctors AS doc ON p.doctor_id = doc.id
                WHERE p.id = $_id";

        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    // =============================================
    // GET MEDICINES FOR A PRESCRIPTION
    // =============================================
    static public function getMedicines($_prescription_id) {
        global $db;

        $sql = "SELECT pm.*, m.name, m.strength 
                FROM prescription_medicines AS pm
                LEFT JOIN medicines AS m ON pm.medicine_id = m.id
                WHERE pm.prescription_id = $_prescription_id";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // GET TESTS FOR A PRESCRIPTION
    // =============================================
    static public function getTests($_prescription_id) {
        global $db;

        $sql = "SELECT pt.*, t.name, t.description 
                FROM prescription_tests AS pt
                LEFT JOIN tests AS t ON pt.test_id = t.id
                WHERE pt.prescription_id = $_prescription_id";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // ADD MEDICINE TO PRESCRIPTION
    // =============================================
    static public function addMedicine($_prescription_id, $_medicine_id, $_dosage, $_duration, $_instructions) {
        global $db;

        $sql = "INSERT INTO prescription_medicines (prescription_id, medicine_id, dosage, duration, instructions) 
                VALUES ('$_prescription_id', '$_medicine_id', '$_dosage', '$_duration', '$_instructions')";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // ADD TEST TO PRESCRIPTION
    // =============================================
    static public function addTest($_prescription_id, $_test_id, $_instructions) {
        global $db;

        $sql = "INSERT INTO prescription_tests (prescription_id, test_id, instructions) 
                VALUES ('$_prescription_id', '$_test_id', '$_instructions')";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // DELETE - prescription delete
    // =============================================
    static public function delete($_id) {
        global $db;

        $db->query("DELETE FROM prescriptions WHERE id = $_id");

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}
?>