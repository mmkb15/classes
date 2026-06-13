<?php
require_once 'config.php';


$sql = "
SELECT p.*, m.name AS mfg FROM product AS p, manufacturer AS m
WHERE p.manufacturer_id = m.id
";
$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

$result_view = $db->query("SELECT * FROM wv_product");
$rows_view = $result_view->fetch_all(MYSQLI_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufacturer</title>
</head>
<body>

    <h2>View Product List</h2>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Manufacturer</th>
        </tr>
        <?php foreach($rows_view as $mfg) : ?>
        <tr>
            <td><?= $mfg['id']; ?></td>
            <td><?= $mfg['name']; ?></td>
            <td><?= $mfg['price']; ?></td>
            <td><?= $mfg['mfg']; ?></td>
        </tr>
        <?php endforeach ?>
    </table>

    <h2>Product List</h2>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Manufacturer</th>
        </tr>
        <?php foreach($rows as $mfg) : ?>
        <tr>
            <td><?= $mfg['id']; ?></td>
            <td><?= $mfg['name']; ?></td>
            <td><?= $mfg['price']; ?></td>
            <td><?= $mfg['mfg']; ?></td>
        </tr>
        <?php endforeach ?>
    </table>

</body>
</html>