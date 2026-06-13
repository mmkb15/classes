<?php
require_once 'db.php';
$result = $db->query("SELECT p.*, m.name AS mfg FROM products AS p, manufactures AS m  where p.manufacture_id = m.id");
if($result){
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($rows);
    // echo "</pre>";
}

$view_result = $db->query("SELECT * FROM vw_product_list");
if($view_result){
    $view_rows = $view_result->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($view_result);
    // echo "</pre>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <nav>
        <a href="manufacturer.php">Manufacturers</a>
        <a href="products.php">Products</a>
    </nav>

    <h1>View Products more than TK 5,000</h1>
    <table width="100%" border="1" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>MFG</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    <?php foreach($view_rows as $item):?>
        <tr align="center">
            <td><?= $item["id"] ?></td>
            <td><?= $item["name"] ?></td>
            <td><?= $item["mfg"] ?></td>
            <td><?= $item["price"] ?></td>
            <td>
                <button>Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>

    <h1>Products List</h1>
    <table width="100%" border="1" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Manufacture ID</th>
            <th>Price</th>
            <th>MFG</th>
            <th>Action</th>
        </tr>
    <?php foreach($rows as $item):?>
        <tr align="center">
            <td><?= $item["id"] ?></td>
            <td><?= $item["name"] ?></td>
            <td><?= $item["manufacture_id"] ?></td>
            <td><?= $item["price"] ?></td>
            <td><?= $item["mfg"] ?></td>
            <td>
                <button>Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>



</body>
</html>