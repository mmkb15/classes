<?php
class Appointment
{
    public $id;
    public $patient_id;
    public $doctor_id;
    public $appointment_date;
    public $status;
    public $created_at;

    public function __construct($_id, $_patient_id, $_doctor_id, $_appointment_date, $_status, $_created_at = null) {
        $this->id = $_id;
        $this->patient_id = $_patient_id;
        $this->doctor_id = $_doctor_id;
        $this->appointment_date = $_appointment_date;
        $this->status = $_status;
        $this->created_at = $_created_at ?? date('Y-m-d H:i:s');
    }

    // =============================================
    // CREATE - new appointment
    // =============================================
    public function create() {
        global $db;

        $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, status) 
                VALUES ('$this->patient_id', '$this->doctor_id', '$this->appointment_date', '$this->status')";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // UPDATE - appointment update
    // =============================================
    public function update() {
        global $db;

        $sql = "UPDATE appointments SET 
                    patient_id = '$this->patient_id', 
                    doctor_id = '$this->doctor_id', 
                    appointment_date = '$this->appointment_date', 
                    status = '$this->status' 
                WHERE id = $this->id";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // READ ALL - all appointments with patient & doctor name
    // =============================================
    static public function readAll() {
        global $db;

        $sql = "SELECT app.*, 
                       pat.name AS patient_name, 
                       doc.name AS doctor_name 
                FROM appointments AS app
                LEFT JOIN patients AS pat ON app.patient_id = pat.id
                LEFT JOIN doctors AS doc ON app.doctor_id = doc.id
                ORDER BY app.id DESC";

        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // READ BY ID - specific appointment
    // =============================================
    static public function readByID($_id) {
        global $db;

        $sql = "SELECT app.*, 
                       pat.name AS patient_name, 
                       doc.name AS doctor_name 
                FROM appointments AS app
                LEFT JOIN patients AS pat ON app.patient_id = pat.id
                LEFT JOIN doctors AS doc ON app.doctor_id = doc.id
                WHERE app.id = $_id";

        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    // =============================================
    // DELETE - appointment delete
    // =============================================
    static public function delete($_id) {
        global $db;

        $db->query("DELETE FROM appointments WHERE id = $_id");

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}
?>