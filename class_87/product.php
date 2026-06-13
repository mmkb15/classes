<?php
require_once('db.php');


$sql ="
SELECT p.*, m.name AS mfg
FROM product AS p, manufacturer AS m
WHERE p.manufacturer_id = m.id
";



$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($rows);
// echo "</pre>";


$result_view = $db->query("SELECT * FROM wv_product");
$rows_view = $result_view->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($rows);
// echo "</pre>";




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

    <h4>View Prodcut List</h4>
    <table border=1 width=500>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact No</th>
        </tr>
        <?php foreach($rows_view as $item) : ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['mfg'] ?></td>
            </tr>
        <?php endforeach ?>

    </table>
    
    <br><br>

    <h4>Prodcut List</h4>
    <table border=1 width=500>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact No</th>
        </tr>
        <?php foreach($rows as $item) : ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['mfg'] ?></td>
            </tr>
        <?php endforeach ?>

    </table>
</body>
</html>