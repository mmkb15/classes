<?php
if (isset($_POST['submit'])) {
    $file = $_FILES["file"];

    if (empty($file["tmp_name"])) {
        $fileMsg = '<p style="color:red;">Please select a file</p>';
    } else {
        $type = mime_content_type($file["tmp_name"]);

        $file_path = $file['name'];

        if ($file["size"] > (400 * 1024)) {
            $fileMsg = '<p style="color:red;">File size cannot be more thatn 400kb</p>';
        } elseif (!($type == "image/jpeg" || $type == "image/png" || $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $type == "application/pdf")) {
            $fileMsg = '<p style="color:red;">File type must be PDF/IMAGE/DOCUMENT</p>';
        } else {
            move_uploaded_file($file['tmp_name'], $file_path);
            $imgPrev = "<img style='height:400px; width:auto;' src='{$file_path}'>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Upload a file</label><br>
        <input type="file" name="file" id=""><br><br>
        <button type="submit" name="submit">Upload</button>
    </form>
    <?= $fileMsg ?? "" ?>
    <?= $imgPrev ?? "" ?>

</body>

</html>