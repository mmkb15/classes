<?php
class Room
{
    static public function readAll() {
        global $db;
        $sql = "SELECT * FROM rooms ORDER BY room_no ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readAvailable() {
        global $db;
        $sql = "SELECT * FROM rooms WHERE status = 'Available' ORDER BY room_no ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readByID($_id) {
        global $db;
        $sql = "SELECT * FROM rooms WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    static public function updateStatus($_id, $_status) {
        global $db;
        $sql = "UPDATE rooms SET status = '$_status' WHERE id = $_id";
        $db->query($sql);
        return $db->error ? $db->error : true;
    }
}
?>