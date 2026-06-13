<?php
if(isset($_POST['submit'])) {
    echo "<pre>";
    print_r($_FILES["image"]);
    echo "</pre>";
    $file = $_FILES["image"];
    // echo $file["size"];    
    $final_path = "uploads/".$file["name"];
    
    if($file["size"] > (2 * 1024 * 1024)) {
        echo "File size should be less than 2mb";
    }
    elseif(($file["type"] == "image/jpeg" || 
        $file["type"] == "image/jpg" || 
        $file["type"] == "image/png" || 
        $file["type"] == "application/pdf" || 
        $file["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") == false) {
        echo "Invalid file type. Please use jpeg, jpg, png, pdf or docx file.";
    }
    else{
        echo "File uploaded successfully";
        move_uploaded_file($file["tmp_name"], $final_path);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit" name="submit">Upload</button>
    </form>
    
</body>
</html>