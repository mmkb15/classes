<?php
require_once('db.php');


if(isset($_POST['sub_btn'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    // echo $name . $address . $contact;

    $db->query("CALL addManufacturer('$name','$address','$contact')");
}

if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_btn'];
    // echo $id;
    $db->query("DELETE FROM manufacturer WHERE id = $id ");
}

$sql = "SELECT * FROM manufacturer";
$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($rows);
// echo "</pre>";


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufacturer</title>
</head>
<body>

    <nav>
        <a href="manufacturer.php">Manufacturer</a> |
        <a href="product.php">Product</a>
    </nav>
    <br>

    <form method="POST">
        <label for="name">Name : </label><br>
        <input type="text" name="name" value="AMD"><br><br>
        
        <label for="address">Address : </label><br>
        <input type="text" name="address" value="USA"><br><br>
        
        <label for="contact">Contact No : </label><br>
        <input type="text" name="contact" value="+1586885632"><br><br>

        <button type="submit" name="sub_btn">ADD Manufacturer</button>
    </form>

<br><br>
    <h2>Manufacturers List</h2>
    <table border="1" cellspacing="0" cellpadding="5" width="800">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact No</th>
            <th>Action</th>
        </tr>
    <?php foreach($rows as $item) : ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['address'] ?></td>
            <td><?= $item['contact_no'] ?></td>
            <td><form method="POST">
                <input type="hidden" name="delete_btn" value="<?= $item['id'] ?>">
                <button type="submit">Delete</button>
            </form></td>
        </tr>
    <?php endforeach; ?>
    </table>

</body>
</html>