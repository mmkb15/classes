<?php
// 1. Check if the form was submitted by checking the button name
if(isset($_POST["submit_btn"])){
    
    // 2. Display the raw file array data in a readable format for debugging
    echo "<pre>";
    print_r($_FILES["image"]);
    echo "</pre>";

    // 3. Store the file array in a variable for easier access
    $file = $_FILES["image"];
    
    // 4. Define the destination path where the file will be saved
    $final_path = "uploads/".$file["name"];

    // 5. Print individual file details
    echo $file["name"]."<br>";      // Original name of the file
    echo $file["full_path"]."<br>"; // Full path provided by the browser (PHP 8.1+)
    echo $file["type"]."<br>";      // MIME type of the file (e.g., image/png)
    echo $file["tmp_name"]."<br>";  // Temporary location where the file is stored on the server
    echo $file["error"]."<br>";     // Error code (0 means success)
    echo $file["size"]."<br>";      // File size in bytes


    // 6. Validate file size (120 * 1024 bytes = 120 KB)
    if($file["size"] > (120 * 1024)){
        echo "File size should be less than 120kb"; // Error if file is too large
    } else {
        // 7. If size is okay, move the file from the temp folder to your permanent "uploads" folder
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
    <title>Image Upload or File Upload</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image"><br><br>
        <button type="submit" name="submit_btn">Upload</button>
    </form>
</body>
</html>