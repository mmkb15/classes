<?php
if(isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_FILES["image"]);
    // echo "</pre>";

    $file = $_FILES["image"];
    // echo $file["size"];    
    $final_path = "uploads/".$file["name"];

    // var_dump(empty($file["tmp_name"]));

    $type = !empty($file["tmp_name"]) ? mime_content_type($file["tmp_name"]) : "";
    // echo $type;
    
    // if($file["size"] == 0) {
    // if(empty($file["tmp_name"])) {
    if(!file_exists($file["tmp_name"])) {
        $msg = "Please select a file";
    }
    elseif($file["size"] > (2 * 1024 * 1024)) {
        $msg = "File size should be less than 2mb";
    }
    elseif(($type == "image/jpeg" || 
        $type == "image/jpg" || 
        $type == "image/png" || 
        $type == "application/pdf" || 
        $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") == false) {
        $msg = "Invalid file type. Please use jpeg, jpg, png, pdf or docx file.";
    }
    else{
        $msg = "<span style='color:green'>File uploaded successfully</span>";
        move_uploaded_file($file["tmp_name"], $final_path);
        $img = "<img src='$final_path' alt='Uploaded image' width='200'>";
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
    <h5 style="color:red"><?= $msg ?? "" ?></h5>
    <?= $img ?? "" ?>
</body>
</html>