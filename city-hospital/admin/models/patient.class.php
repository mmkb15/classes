<?php

class Patient
{
    public $id;
    public $name;
    public $age;
    public $gender_id;
    public $phone;
    public $address;
    public $image;
    public $created_at;

    public function __construct($_id, $_name, $_age, $_gender_id, $_phone, $_address, $_image = null, $_created_at = null) {
        $this->id         = $_id;
        $this->name       = $_name;
        $this->age        = $_age;
        $this->gender_id  = $_gender_id;
        $this->phone      = $_phone;
        $this->address    = $_address;
        $this->image      = $_image;
        $this->created_at = $_created_at ?? date('Y-m-d H:i:s');
    }

    // =============================================
    // CREATE - new patient insert 
    // =============================================
    public function create() {
        global $db;

        $sql = "INSERT INTO patients 
                (
                name, 
                age, 
                gender_id, 
                phone, 
                address,
                image
                ) 
                VALUES 
                (
                '$this->name',
                '$this->age',
                '$this->gender_id',
                '$this->phone',
                '$this->address',
                '$this->image'
                )";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // UPDATE - existing patient data update 
    // =============================================
    public function update() {
        global $db;

        $sql = "UPDATE patients SET 
                    name            = '$this->name', 
                    age             = '$this->age', 
                    gender_id       = '$this->gender_id', 
                    phone           = '$this->phone', 
                    address         = '$this->address'";
                
                // Add this condition: only set image if a new one is provided
                if ($this->image !== null) {
                    $sql .= ", image = '$this->image'";
                }

                $sql .= " WHERE id = $this->id";


        // Debug Query for print
        // echo "<pre>SQL: " . $sql . "</pre>";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // READ ALL - all patient list 
    // =============================================
    static public function readAll() {
        global $db;

        $sql    = "SELECT p.id, p.name, p.age, g.name AS gender_name, p.phone, p.address , p.image, p.created_at 
                   FROM patients AS p , genders AS g
                   WHERE p.gender_id = g.id 
                   ORDER BY p.id DESC";

    // $sql = "SELECT p.id, p.name, p.age, p.gender_id, p.phone, p.address, p.image, p.created_at, g.name AS gender_name 
    //         FROM patients AS p 
    //         LEFT JOIN genders AS g ON p.gender_id = g.id 
    //         ORDER BY p.id DESC";

        $result = $db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // READ BY ID - spesafic patient  data 
    // =============================================
    static public function readByID($_id) {
        global $db;

        $sql    = "SELECT * 
                   FROM patients 
                   WHERE id = $_id";
        $result = $db->query($sql);

        return $result->fetch_assoc(); // single row return 
    }

    // =============================================
    // DELETE - patient delete 
    // =============================================
    static public function delete($_id) {
        global $db;

        // Get the record first to check for an existing image
        $row = self::readByID($_id);
        if (!empty($row['image'])) {
            $file_path = 'admin/assets/uploads/patients/' . $row['image'];
            if (file_exists($file_path)) {
                unlink($file_path); // Delete the file from the server
            }
        }


        $db->query("DELETE FROM patients WHERE id = $_id");

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    /*
        * Get full patient history with all related data
     */
    static public function getFullHistory($_patient_id) {
        global $db;
        
        $history = [
            'patient' => null,
            'admissions' => [],
            'prescriptions' => [],
            'bills' => []
        ];
        
        // 1. Get patient info
        $history['patient'] = self::readByID($_patient_id);
        
        // 2. Get all admissions
        $sql = "SELECT a.*, r.room_no, r.room_type 
                FROM admissions AS a
                LEFT JOIN rooms AS r ON a.room_id = r.id
                WHERE a.patient_id = $_patient_id
                ORDER BY a.id DESC";
        $result = $db->query($sql);
        $history['admissions'] = $result->fetch_all(MYSQLI_ASSOC);
        
        // 3. Get all prescriptions with medicines and tests
        $sql = "SELECT p.*, d.name AS doctor_name 
                FROM prescriptions AS p
                LEFT JOIN doctors AS d ON p.doctor_id = d.id
                WHERE p.patient_id = $_patient_id
                ORDER BY p.id DESC";
        $result = $db->query($sql);
        $prescriptions = $result->fetch_all(MYSQLI_ASSOC);
        
        foreach($prescriptions as &$prescription) {
            // Get medicines for this prescription
            $med_sql = "SELECT pm.*, m.name AS medicine_name, m.strength 
                        FROM prescription_medicines AS pm
                        LEFT JOIN medicines AS m ON pm.medicine_id = m.id
                        WHERE pm.prescription_id = {$prescription['id']}";
            $med_result = $db->query($med_sql);
            $prescription['medicines'] = $med_result->fetch_all(MYSQLI_ASSOC);
            
            // Get tests for this prescription
            $test_sql = "SELECT pt.*, t.name AS test_name 
                        FROM prescription_tests AS pt
                        LEFT JOIN tests AS t ON pt.test_id = t.id
                        WHERE pt.prescription_id = {$prescription['id']}";
            $test_result = $db->query($test_sql);
            $prescription['tests'] = $test_result->fetch_all(MYSQLI_ASSOC);
        }
        $history['prescriptions'] = $prescriptions;
        
        // 4. Get all bills
        $sql = "SELECT * FROM billings 
                WHERE patient_id = $_patient_id
                ORDER BY id DESC";
        $result = $db->query($sql);
        $history['bills'] = $result->fetch_all(MYSQLI_ASSOC);
        
        return $history;
    }
    



}









?>
