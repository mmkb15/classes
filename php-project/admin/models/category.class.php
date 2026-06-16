<?php
class Category 
{    
    static public function readAll() {
        global $db;
        $sql = "SELECT id, name FROM categories ORDER BY name ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>