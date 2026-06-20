<?php
$host     = 'localhost';
$dbname   = 'hospital';
$username = 'root';
$password = '';  // XAMPP এ default password নেই

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<div style='color:red; padding:20px;'>
        <h3>Database Connection Failed!</h3>
        <p>" . $e->getMessage() . "</p>
        <p>XAMPP চালু আছে তো? MySQL service on আছে?</p>
    </div>");
}
?>
