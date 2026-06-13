<?php
require_once('db.php');


$sql = "
SELECT p.*, m.name AS mfg FROM manufacturer AS m, product AS p 
WHERE p.manufacturer_id = m.id;
";
$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($rows);
// echo "</pre>";

$result_view = $db->query("SELECT * FROM vw_product");
$rows_view = $result_view ->fetch_all(MYSQLI_ASSOC);
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
<body>

    <nav>
        <a href="manufacturer.php">Manufacturer</a> |
        <a href="product.php">Product</a>
    </nav>
    <br>

    <h2> VIEW Product List  ( Price > 5000 )</h2>
    <table border="1" cellspacing=0 cellpadding=5 width="800">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Manufacturer</th>
        </tr>
    <?php foreach($rows_view as $item) : ?>
        <tr align="center">
            <td><b><?= $item['id'] ?></b></td>
            <td><?= $item['name'] ?></td>
            <td><b><?= $item['price'] ?></b></td>
            <td><?= $item['mfg'] ?></td>
        </tr>
    <?php endforeach; ?>
    </table>


    <br><br>
    <h2>Prodcut List</h2>
    <table border="1" width="800">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Manufacturer</th>
        </tr>
    <?php foreach($rows as $item) : ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><?= $item['mfg'] ?></td>
        </tr>
    <?php endforeach; ?>
    </table>

</body>
</html>