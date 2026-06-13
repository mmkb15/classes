<?php
require_once('db.php');


if(isset($_POST['add_btn'])){
    $name = $_POST['name'];
    $qua = $_POST['qua'];
    $cont = $_POST['cont'];
    // echo $name . $qua . $cont;
    $db->query("call newTeacher('$name', '$qua', '$cont')");
}


if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    // echo $id;
    $db->query("delete from teacher where id = $id");
}

$sql = "select * from teacher";
$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
// print_r($rows);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
</head>
<body>
    <form method="post">
        Name : <br>
        <input type="text" name="name" id="name"><br><br>
        Qualification : <br>
        <input type="text" name="qua" id="qua"><br><br>
        Contact No : <br>
        <input type="text" name="cont" id="cont"><br><br>
        <button type="submit" name="add_btn">Add Teacher</button>
    </form>

    <h2>Teacher list</h2>
    <table border=1 width=500>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Qualificaion</th>
            <th>Contact No</th>
            <th>Action</th>
        </tr>
    <?php foreach($rows as $item) :?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['qualification'] ?></td>
            <td><?= $item['contact_no'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="delete_id" value="<?= $item['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>