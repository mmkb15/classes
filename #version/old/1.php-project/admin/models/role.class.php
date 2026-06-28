<?php

class Role
{
    static public function readAll(){
        global $db;
        $sql = "SELECT id, name FROM roles order by name ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


}




?>