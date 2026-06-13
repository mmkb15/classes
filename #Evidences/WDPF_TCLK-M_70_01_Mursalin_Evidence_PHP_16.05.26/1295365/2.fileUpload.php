<?php
if(isset($_POST['upload_btn'])) {
   $file = $_FILES['file'];
//    echo "<pre>";
//    var_dump($file);
//    echo "</pre>";

   if(
        !(
        $file["type"] === "image/jpeg" ||
        $file["type"] === "image/png" ||
        $file["type"] === "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||
        $file["type"] === "application/pdf"
        )
    ){
        $msg = "File Type must be PDF/IMAGE/Documnet";
    } elseif($file["size"] > 400 * 1024) {
        $msg = "File size cannot be more than 400kb";
    } else {
    move_uploaded_file($file["tmp_name"], $file["name"]);
        $msg = "File uploaded successfully";
        $file_path = $file['name'];
        $img_hmtl = "<img style='height:400px; width:auto;' src='{$file_path}'>";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2. File Upload</title>
</head>
<body>
        <form action="" method="POST" enctype="multipart/form-data">
        <label for="file">Upload Your file</label><br>
        <input type="file" name="file" id="file"><br><br>
        <button type="submit" name="upload_btn">Upload</button>
    </form>
    <p><?= $msg ?? ""; ?></p>
    <?php echo $img_hmtl ?? ""; ?>
</body>
</html>