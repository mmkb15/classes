<?php
if(isset($_POST["submit_btn"])){
    
    echo "<pre>";
    print_r($_FILES["image"]);
    echo "</pre>";                                   

    $file = $_FILES["image"];

    
    $final_path = "uploads/".$file["name"];
    $type = mime_content_type($file["tmp_name"]);
    echo $type;


    // if($file["size" == 0])
    // if($file['error']))
    // if(empty($file["tem_name")])
    if (!file_exists($file["tmp_name"])) {
        $msgError = "Please select a file first.";
    }elseif($file["size"] > (2 * 1024 * 1024)){
        $msgError = "File size should be less than 2mb"; // Error if file is too large
    }elseif (
        (   $type   == "image/jpeg"                                                                           ||
            $type   == "image/png"                                                                            ||
            $type   == "application/pdf"                                                                      ||
            $type   == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") == false
        ) {
        $msgError = "Sorry, that file type isn't supported. Please upload an Image (JPG, PNG), a PDF, or a Word Document";
    }else {
        // 7. If size is okay, move the file from the temp folder to your permanent "uploads" folder
        $msg =  "Image uploaded successfully";
        move_uploaded_file($file["tmp_name"], $final_path);
        $img = "<img src='$final_path' alt='Uploaded Image' width='300px'>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload or File Upload</title>
    <style>
        .success{
            color:green;
        }
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image"><br><br>
        <button type="submit" name="submit_btn">Upload</button>
    </form>
    <h5 class="success"><?= $msg ?? ""; ?></h5>
    <h5 class="error"><?= $msgError ?? ""; ?></h5>
        <?= $img ?? "" ; ?>
    
</body>