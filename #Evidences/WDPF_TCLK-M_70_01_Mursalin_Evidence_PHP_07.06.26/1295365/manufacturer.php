<?php
require_once 'config.php';


if(isset($_POST['mfg_btn'])){
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    // echo $name . "<br>" . $contact . "<br>" . $address;

    $db->query("CALL addManufacturer ('$name','$address','$contact')");

}

if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_btn'];
    // echo $id;
    $db->query("delete from manufacturer where id = $id");


}

$result = $db->query("SELECT * FROM manufacturer");
// echo "<pre>";
// print_r($result);
// echo "</pre>";

$mfgs = $result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($mfgs);
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
    <form method="POST">
        <label for="">Name : </label><br>
        <input type="text" name="name"><br><br>
        
        <label for="">Contact : </label><br>
        <input type="text" name="contact"><br><br>

        <label for="">Address : </label><br>
        <input type="text" name="address"><br><br>

        <button type="submit" name="mfg_btn">Add Product</button>
    </form>

    <h2>Manufacture List</h2>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
        <?php foreach($mfgs as $mfg) : ?>
        <tr>
            <td><?= $mfg['id']; ?></td>
            <td><?= $mfg['name']; ?></td>
            <td><?= $mfg['address']; ?></td>
            <td><?= $mfg['contact_no']; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="delete_btn" value=<?= $mfg['id'] ?>>
                    <button type="submit">Delete</button>
                </form>
        </td>
        </tr>
        <?php endforeach ?>
    </table>

</body>
</html>