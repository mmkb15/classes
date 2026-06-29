<?php

class Doctor
{
    public $id;
    public $dept_id ;
    public $name;
    public $specialization;
    public $phone;
    public $email;
    public $image;
    public $created_at;

    public function __construct($_id, $_dept_id , $_name, $_specialization, $_phone, $_email, $_image = null, $_created_at = null) {
        $this->id         = $_id;
        $this->dept_id        = $_dept_id ;
        $this->name       = $_name;
        $this->specialization  = $_specialization;
        $this->phone      = $_phone;
        $this->email    = $_email;
        $this->image = $_image;   // <-- new
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
                email,
                image
                ) 
                VALUES 
                (
                '$this->dept_id',
                '$this->name',
                '$this->specialization',
                '$this->phone',
                '$this->email',
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
    // UPDATE - existing doctor data update 
    // =============================================
    public function update() {
        global $db;
        $sql = "UPDATE doctors SET 
                    dept_id = '$this->dept_id', 
                    name = '$this->name', 
                    specialization = '$this->specialization', 
                    phone = '$this->phone', 
                    email = '$this->email'";
        if ($this->image !== null) {
            $sql .= ", image = '$this->image'";
        }
        $sql .= " WHERE id = $this->id";
        $db->query($sql);
        return $db->error ? $db->error : true;
    }

    // =============================================
    // READ ALL - all doctor list 
    // =============================================
    static public function readAll() {
        global $db;

        $sql    = "SELECT doc.*, dept.name AS department 
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
    $row = self::readByID($_id);
    if (!empty($row['image'])) {
        $file = 'assets/uploads/doctors/' . $row['image'];
        if (file_exists($file)) unlink($file);
    }
    $db->query("DELETE FROM doctors WHERE id = $_id");
    return $db->error ? $db->error : true;
    }


}

?>
