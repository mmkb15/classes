<?php
    require_once "db-config.php";

    
    $result = $db->query("select * from manufactures");
    if($result){
        // echo "<h2 style='color:green'>Connected Successfully</h2>";
        $mfg = $result->fetch_all(MYSQLI_ASSOC);
        echo "<pre>";
        print_r($mfg);
        echo "</pre>";
    }else{
        echo $db->error;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta address="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufuctures</title>
</head>
<body>
    <nav>
        <a href="manufectures.php">Manufactures</a>
        <a href="product.php">Manufactures</a>
    </nav>
    <h2>Add New Manufacturer</h2>
    <form action="" method="POST">
        
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name">
        <br><br>
        
        <label for="address">Address</label><br>
        <textarea name="address" id="address">
        </textarea>
        <br><br>

        <input type="checkbox" name="active" id="active">
        <label for="active">Is active</label><br>
        <br><br>

        <button type="submit" name="add_mfg">Save</button>



        <h3>Manufacturer List</h3>
        <table border=1>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($mfg)):
                    foreach($mfg as $item) : 
                    $status = $item['is_active'] ? "Active" : "Inactive";
                    ?>
                    
                    <tr>
                        <td><?= $item['id']?></td> 
                        <td><?= $item['name']?></td> 
                        <td><?= $item['address']?></td>
                        <td><?=  $status ?></td>
                    </tr>
                <?php 
                endforeach; 
                endif;
                ?>

            </tbody>
        </table>

    </form>
</body>
</html>