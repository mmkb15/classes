<?php 
if(isset($_POST['upload'])){
    $file = $_FILES["file"];

    $type = mime_content_type($file["tmp_name"]);
    

  
  if($file["size"] > 500 * 1024) {
       $msg = '<p style="color:red;">Maximum file size is 500KB</p>';
     } elseif(!(
      $type == "image/jpeg" ||
      $type =="image/jpeg"  || 
      $type == "image/png"
      )){
        $msg = '<p style="color:red;">File type musb be jpg,png,jpeg</p>';
      } else {
        move_uploaded_file($file['tmp_name'],$file['name']);
        $msg = '<p style="color:green;">Image uploaded successfully</p>';
        $imgPrev = "<img src='{$file["name"]}' style='height:200px; width: auto;'>";
      }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3. Upload</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Upload Your file</label><br>
        <input type="file" name="file" required><br><br>
        <button type="submit" name="upload">Upload</button>
        <?= $msg ?? ""; ?>
        <?= $imgPrev ?? ""; ?>
    </form>
</body>
</html>