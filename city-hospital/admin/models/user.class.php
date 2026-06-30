<?php

class User
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $created_at;

    public function __construct($_id, $_name, $_email, $_password, $_role_id, $_created_at = null) {
        $this->id = $_id;
        $this->name = $_name;
        $this->email = $_email;
        $this->password = $_password;
        $this->role_id = $_role_id;
        $this->created_at = $_created_at ?? date('Y-m-d H:i:s');
    }

    // =============================================
    // REGISTER - Create new user
    // =============================================
    public function register() {
        global $db;

        // Hash password before saving
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, role_id) 
                VALUES ('$this->name', '$this->email', '$hashed_password', '$this->role_id')";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return $db->insert_id;
        }
    }

    // =============================================
    // LOGIN - Verify credentials
    // =============================================
    static public function login($_email, $_password) {
        global $db;

        $sql = "SELECT * FROM users WHERE email = '$_email'";
        $result = $db->query($sql);
        $user = $result->fetch_assoc();

        if ($user && password_verify($_password, $user['password'])) {
            // Start session and store user data
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role_id'] = $user['role_id'];
            
            return true;
        } else {
            return false;
        }
    }

    // =============================================
    // LOGOUT - Destroy session
    // =============================================
    static public function logout() {
        session_destroy();
        return true;
    }

    // =============================================
    // CHECK IF USER IS LOGGED IN
    // =============================================
    static public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // =============================================
    // GET USER BY ID
    // =============================================
    static public function readByID($_id) {
        global $db;

        $sql = "SELECT u.*, r.name AS role_name 
                FROM users u
                LEFT JOIN roles r ON u.role_id = r.id
                WHERE u.id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    // =============================================
    // GET ALL USERS
    // =============================================
    static public function readAll() {
        global $db;

        $sql = "SELECT u.*, r.name AS role_name 
                FROM users u
                LEFT JOIN roles r ON u.role_id = r.id
                ORDER BY u.id DESC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // =============================================
    // UPDATE USER
    // =============================================
    public function update() {
        global $db;

        $sql = "UPDATE users SET 
                    name = '$this->name', 
                    email = '$this->email', 
                    role_id = '$this->role_id'";

        // Only update password if a new one is provided
        if (!empty($this->password)) {
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
            $sql .= ", password = '$hashed_password'";
        }

        $sql .= " WHERE id = $this->id";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // =============================================
    // DELETE USER
    // =============================================
    static public function delete($_id) {
        global $db;

        $db->query("DELETE FROM users WHERE id = $_id");

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}

?>