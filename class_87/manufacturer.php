<?php
require_once('db.php');

if(isset($_POST['mfg_btn'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $db->query("call addManufacturer('$name','$address','$contact')");
}



if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $db->query("delete from manufacturer where id = $id");
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
    <h1>Add Manufacturer List</h1>
    <form method="POST">
            Name : <br>
            <input type="text" name="name"><br><br>
            Address : <br>
            <input type="text" name="address"><br><br>
            Contact No : <br>
            <input type="text" name="contact"><br><br>
            <button type="submit" name="mfg_btn">Add MFG</button>
    </form>

    <h4>Manufacturer List</h4>
    <table border=1 width=500>
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
                <td>
                    <form method="POST">
                        <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

    </table>
</body>
</html>