<?php

class Doctor
{
    public $id;
    public $dept_id ;
    public $name;
    public $specialization;
    public $phone;
    public $email;
    public $created_at;

    public function __construct($_id, $_dept_id , $_name, $_specialization, $_phone, $_email, $_created_at = null) {
        $this->id         = $_id;
        $this->dept_id        = $_dept_id ;
        $this->name       = $_name;
        $this->specialization  = $_specialization;
        $this->phone      = $_phone;
        $this->email    = $_email;
        $this->created_at = $_created_at ?? date('Y-m-d H:i:s');
    }

    // =============================================
    // CREATE - new doctor insert 
    // =============================================
    public function create() {
        global $db;

        $sql = "INSERT INTO doctors 
                (
                dept_id, 
                name, 
                specialization, 
                phone, 
                email
                ) 
                VALUES 
                (
                '$this->dept_id',
                '$this->name',
                '$this->specialization',
                '$this->phone',
                '$this->email'
                )";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // UPDATE - existing doctor data update 
    // =============================================
    public function update() {
        global $db;

        $sql = "UPDATE doctors SET 
                    dept_id                 = '$this->dept_id', 
                    name                    = '$this->name', 
                    specialization          = '$this->specialization', 
                    phone                   = '$this->phone', 
                    email                   = '$this->email' 
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
    // READ ALL - all doctor list 
    // =============================================
    static public function readAll() {
        global $db;

        $sql    = "SELECT doc.id, doc.name, doc.specialization, doc.phone, doc.email, doc.created_at, dept.name AS department 
                   FROM doctors AS doc, departments AS dept
                   WHERE doc.dept_id = dept.id
                   ORDER BY doc.id DESC";

        $result = $db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // READ BY ID - specific doctor data with department name
    // =============================================
    static public function readByID($_id) {
        global $db;

        $sql = "SELECT doc.*, dept.name AS department 
                FROM doctors AS doc
                LEFT JOIN departments AS dept ON doc.dept_id = dept.id
                WHERE doc.id = $_id";

        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    // =============================================
    // DELETE - doctor delete 
    // =============================================
    static public function delete($_id) {
        global $db;

        $db->query("DELETE FROM doctors WHERE id = $_id");

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}

?>
