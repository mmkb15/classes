<?php
/**
 * Medicine Class - Full CRUD Operations
 */
class Medicine
{
    public $id;
    public $name;
    public $strength;
    public $price;
    public $created_at;

    public function __construct($_id, $_name, $_strength, $_price, $_created_at = null) {
        $this->id = $_id;
        $this->name = $_name;
        $this->strength = $_strength;
        $this->price = $_price;
        $this->created_at = $_created_at ?? date('Y-m-d H:i:s');
    }

    public function create() {
        global $db;
        $sql = "INSERT INTO medicines (name, strength, price) 
                VALUES ('$this->name', '$this->strength', '$this->price')";
        $db->query($sql);
        return $db->error ? $db->error : true;
    }

    public function update() {
        global $db;
        $sql = "UPDATE medicines SET 
                    name = '$this->name', 
                    strength = '$this->strength', 
                    price = '$this->price' 
                WHERE id = $this->id";
        $db->query($sql);
        return $db->error ? $db->error : true;
    }

    static public function readAll() {
        global $db;
        $sql = "SELECT * FROM medicines ORDER BY name ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readByID($_id) {
        global $db;
        $sql = "SELECT * FROM medicines WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    static public function delete($_id) {
        global $db;
        $db->query("DELETE FROM medicines WHERE id = $_id");
        return $db->error ? $db->error : true;
    }
}
?>