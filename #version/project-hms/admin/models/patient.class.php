<?php

class Patient
{
    public $id;
    public $name;
    public $age;
    public $gender_id;
    public $phone;
    public $address;
    public $created_at;

    public function __construct($_id, $_name, $_age, $_gender_id, $_phone, $_address, $_created_at = null) {
        $this->id         = $_id;
        $this->name       = $_name;
        $this->age        = $_age;
        $this->gender_id  = $_gender_id;
        $this->phone      = $_phone;
        $this->address    = $_address;
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
                address
                ) 
                VALUES 
                (
                '$this->name',
                '$this->age',
                '$this->gender_id',
                '$this->phone',
                '$this->address'
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
                    address         = '$this->address' 
                WHERE id = $this->id";


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

        $sql    = "SELECT p.id, p.name, p.age, g.name AS gender_name, p.phone, p.address, p.created_at 
                   FROM patients AS p , genders AS g
                   WHERE p.gender_id = g.id 
                   ORDER BY p.id DESC";
        $result = $db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // READ BY ID - spesafic patient  data 
    // =============================================
    static public function readByID($_id) {
        global $db;

        $sql    = "SELECT id, name, age, gender_id, phone, address, created_at 
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

        $db->query("DELETE FROM patients WHERE id = $_id");

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}

?>
