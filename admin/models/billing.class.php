<?php
/**
 * Billing Class - With Auto Calculation
 */
class Billing
{
    public $id;
    public $patient_id;
    public $admission_id;
    public $amount;
    public $bill_date;
    public $description;

    public function __construct($_id, $_patient_id, $_admission_id, $_amount, $_bill_date, $_description) {
        $this->id = $_id;
        $this->patient_id = $_patient_id;
        $this->admission_id = $_admission_id;
        $this->amount = $_amount;
        $this->bill_date = $_bill_date;
        $this->description = $_description;
    }

    /**
     * Create a new bill
     */
    public function create() {
        global $db;
        $sql = "INSERT INTO billings (patient_id, admission_id, amount, bill_date, description) 
                VALUES ('$this->patient_id', '$this->admission_id', '$this->amount', '$this->bill_date', '$this->description')";
        $db->query($sql);
        return $db->error ? $db->error : true;
    }

    /**
     * Update an existing bill
     */
    public function update() {
        global $db;
        $sql = "UPDATE billings SET 
                    patient_id = '$this->patient_id', 
                    admission_id = '$this->admission_id', 
                    amount = '$this->amount', 
                    bill_date = '$this->bill_date', 
                    description = '$this->description' 
                WHERE id = $this->id";
        $db->query($sql);
        return $db->error ? $db->error : true;
    }

    /**
     * Get all bills with patient names
     */
    static public function readAll() {
        global $db;

        $sql = "SELECT b.*, 
                    p.name AS patient_name,
                    p.image AS patient_image 
                FROM billings AS b
                LEFT JOIN patients AS p ON b.patient_id = p.id
                ORDER BY b.id DESC";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get a single bill by ID with patient name
     */
    static public function readByID($_id) {
        global $db;
        $sql = "SELECT b.*, p.name AS patient_name 
                FROM billings AS b
                LEFT JOIN patients AS p ON b.patient_id = p.id
                WHERE b.id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    /**
     * Delete a bill by ID
     */
    static public function delete($_id) {
        global $db;
        $db->query("DELETE FROM billings WHERE id = $_id");
        return $db->error ? $db->error : true;
    }

    // =============================================
    // AUTO CALCULATION METHODS (FIXED)
    // =============================================

    /**
     * Calculate total cost for a patient
     * Returns an array with breakdown and total
     */
    static public function calculatePatientBill($_patient_id) {
        global $db;

        $breakdown = [
            'admission' => 0,
            'medicines' => 0,
            'tests' => 0,
            'total' => 0,
            'admission_details' => null
        ];

        // 1. Calculate admission cost (if currently admitted)
        $sql = "SELECT a.*, r.rate_per_day, r.room_type, r.room_no 
                FROM admissions AS a
                LEFT JOIN rooms AS r ON a.room_id = r.id
                WHERE a.patient_id = $_patient_id AND a.status = 'Admitted'
                ORDER BY a.id DESC LIMIT 1";
        $result = $db->query($sql);
        $admission = $result->fetch_assoc();

        if($admission) {
            $admit_date = new DateTime($admission['admit_date']);
            $today = new DateTime();
            $days = $admit_date->diff($today)->days + 1; // +1 for inclusive
            $rate = $admission['rate_per_day'] ?? 500;
            $breakdown['admission'] = $days * $rate;
            $breakdown['admission_details'] = [
                'days' => $days,
                'rate_per_day' => $rate,
                'room' => $admission['room_no'] ?? 'N/A',
                'room_type' => $admission['room_type'] ?? 'General',
                'admission_id' => $admission['id']
            ];
        }

        // 2. Calculate medicine costs from prescriptions
        $sql = "SELECT SUM(m.price) AS total_med_price 
                FROM prescription_medicines AS pm
                LEFT JOIN medicines AS m ON pm.medicine_id = m.id
                LEFT JOIN prescriptions AS p ON pm.prescription_id = p.id
                WHERE p.patient_id = $_patient_id";
        $result = $db->query($sql);
        $med = $result->fetch_assoc();
        $breakdown['medicines'] = $med['total_med_price'] ?? 0;

        // 3. Calculate test costs from prescriptions
        $sql = "SELECT SUM(t.price) AS total_test_price 
                FROM prescription_tests AS pt
                LEFT JOIN tests AS t ON pt.test_id = t.id
                LEFT JOIN prescriptions AS p ON pt.prescription_id = p.id
                WHERE p.patient_id = $_patient_id";
        $result = $db->query($sql);
        $test = $result->fetch_assoc();
        $breakdown['tests'] = $test['total_test_price'] ?? 0;

        $breakdown['total'] = $breakdown['admission'] + $breakdown['medicines'] + $breakdown['tests'];

        return $breakdown;
    }
}
?>