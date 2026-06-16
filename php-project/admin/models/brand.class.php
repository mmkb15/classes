<?php
class Brand 
{    
    static public function readAll() {
        global $db;
        $sql = "SELECT id, name FROM brands ORDER BY name ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>