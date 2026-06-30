<?php

require_once 'room.class.php'; 

class Admission
{
    public $id;
    public $patient_id;
    public $room_id;
    public $admit_date;
    public $discharge_date;
    public $status;

    public function __construct($_id, $_patient_id, $_room_id, $_admit_date, $_discharge_date = null, $_status = 'Admitted') {
        $this->id = $_id;
        $this->patient_id = $_patient_id;
        $this->room_id = $_room_id;
        $this->admit_date = $_admit_date;
        $this->discharge_date = $_discharge_date;
        $this->status = $_status;
    }

    // =============================================
    // CREATE - new admission
    // =============================================
    public function create() {
        global $db;

        $sql = "INSERT INTO admissions (patient_id, room_id, admit_date, status) 
                VALUES ('$this->patient_id', '$this->room_id', '$this->admit_date', '$this->status')";

        $db->query($sql);
        $last_id = $db->insert_id;

        if ($db->error) {
            return $db->error;
        } else {
            // Update room status to Occupied
            Room::updateStatus($this->room_id, 'Occupied');
            return $last_id;
        }
    }

    // =============================================
    // UPDATE - discharge patient
    // =============================================
    public function discharge() {
        global $db;

        $sql = "UPDATE admissions SET 
                    discharge_date = '$this->discharge_date', 
                    status = 'Discharged' 
                WHERE id = $this->id";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            // Update room status to Available
            Room::updateStatus($this->room_id, 'Available');
            return true;
        }
    }

    // =============================================
    // READ ALL - with patient & room info
    // =============================================
    static public function readAll() {
        global $db;

        $sql = "SELECT adm.*, 
                    pat.name AS patient_name,
                    pat.image AS patient_image,
                    rm.room_no 
                FROM admissions AS adm
                LEFT JOIN patients AS pat ON adm.patient_id = pat.id
                LEFT JOIN rooms AS rm ON adm.room_id = rm.id
                ORDER BY adm.id DESC";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // READ BY ID
    // =============================================
    static public function readByID($_id) {
        global $db;

        $sql = "SELECT adm.*, 
                       pat.name AS patient_name, 
                       pat.phone AS patient_phone,
                       rm.room_no 
                FROM admissions AS adm
                LEFT JOIN patients AS pat ON adm.patient_id = pat.id
                LEFT JOIN rooms AS rm ON adm.room_id = rm.id
                WHERE adm.id = $_id";

        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    // =============================================
    // DELETE - admission delete
    // =============================================
    static public function delete($_id) {
        global $db;

        // First get room_id
        $admission = self::readByID($_id);
        $room_id = $admission['room_id'];

        $db->query("DELETE FROM admissions WHERE id = $_id");

        if ($db->error) {
            return $db->error;
        } else {
            // Update room status to Available
            Room::updateStatus($room_id, 'Available');
            return true;
        }
    }

    // =============================================
    // GET CURRENT ADMISSIONS (Not discharged)
    // =============================================
    static public function getCurrentAdmissions() {
        global $db;

        $sql = "SELECT adm.*, 
                       pat.name AS patient_name, 
                       rm.room_no 
                FROM admissions AS adm
                LEFT JOIN patients AS pat ON adm.patient_id = pat.id
                LEFT JOIN rooms AS rm ON adm.room_id = rm.id
                WHERE adm.status = 'Admitted'
                ORDER BY adm.id DESC";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>