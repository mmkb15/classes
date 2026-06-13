<?php
require_once 'db.php';

if(isset($_POST["add_mfg"])) {
    $name = $_POST["name"];
    $address = $_POST["address"];
    // echo $name."<br>".$address;
    $db->query("CALL createManufacturer('$name', '$address')");
}


// Delete Manufacturers
if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $db->query("DELETE FROM manufactures WHERE id = $id");
}

// Show All Manufacturers
$result = $db->query("SELECT * FROM manufactures order by id desc");
if($result){
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($rows);
    // echo "</pre>";
}



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
        <a href="manufacturer.php">Manufacturers</a>
        <a href="products.php">Products</a>
    </nav>
    <h1>Manufacturers List</h1>

    <form method="POST">
        Name: <br>
        <input type="text" name="name"> <br><br>
        Address: <br>
        <input type="text" name="address"><br><br>
        <input type="submit" name="add_mfg" value="Add Manufacturer"><br><br>
    </form>

    <table width="100%" border="1" cellspacing="0" >
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    <?php foreach($rows as $item):?>
        <tr align="center">
            <td><?= $item["id"] ?></td>
            <td><?= $item["name"] ?></td>
            <td><?= $item["address"] ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="delete_id" value="<?= $item['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

    </table>
</body>
</html>