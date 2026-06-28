<?php
class User 
{
    public $id;
    public $name;
    public $email;
    public $role_id;
    private $password;

    public function __construct($_id, $_name, $_email, $_role_id, $_password = null) {
        $this->id = $_id;
        $this->name = $_name;
        $this->email = $_email;
        $this->role_id = $_role_id;
        $this->password = $_password;
    }
    public function create() {
      global $db;
      $sql = "INSERT INTO users (name, email, role_id, password) 
            VALUES ('$this->name', '$this->email', $this->role_id, '$this->password')";
      $result = $db->query($sql);
        // if($result){
        //     return $db->insert_id;
        // }else{
        //     return $db->error;
        // }
      if($db->error){
        return $db->error;
      }else{
        return true;
      }
    }
    public function update() {
      global $db;
      $sql = "UPDATE users SET 
      name = '$this->name', 
      email = '$this->email', 
      role_id = $this->role_id 
      WHERE id = $this->id";      
      $db->query($sql);
      // if($db->error){
      //   return $db->error;
      // }else{
      //   return true;
      // }
    }
    static public function readAll($_pg_no = 1, $_limit = 2 ) {
        global $db;
        $skip = ($_pg_no - 1) * $_limit;
        $sql = "SELECT id, name, email FROM users ORDER BY id DESC LIMIT $_limit offset $skip";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    static public function readById($_id) {
       global $db;
        $sql = "SELECT id, name, email, role_id FROM users WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }
    static public function delete($_id) {
      global $db;
      $db->query("DELETE FROM users WHERE id = $_id");
      // if($db->affected_rows > 0){
      //   return true;
      // }
      if($db->error){
        return $db->error;
      }else{
        return true;
      }
    }
    static public function getPageNo($_no_of_rows){
      global $db;
      $sql      = "select count(id) as total from users";
      $result   = $db->query($sql);
      $row      = $result->fetch_assoc();
      return ceil($row['total']/$_no_of_rows);
    }
    // protected function getPass(){
    //  return $this->password; 
    // }


}

?>