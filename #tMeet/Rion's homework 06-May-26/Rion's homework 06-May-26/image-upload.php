<?php
if (isset($_POST['submit'])) {
    $image_file = $_FILES['image_file'];
    /*  echo "<pre>";
    print_r($image_file);
    echo "</pre>"; */
    $final_path = "uploads/" . $image_file["name"];


    if (
        !($image_file["type"] === "image/jpeg" ||
            $image_file["type"] === "image/png" ||
            $image_file["type"] === "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||
            $image_file["type"] === "application/pdf")
    ) {
        $msg = "<p class='failed'>Wrong image file type</p>";
    } elseif ($image_file["size"] > 2 * 1024 * 1024) {
        $msg = "<p class='failed'>Image connot be more than 2mb</p>";
    } else {
        move_uploaded_file($image_file["tmp_name"], $final_path);
        $msg = "<p class='success'>Image uploaded successfully</p>";
        $img_HTML = "<img class='image' src='{$final_path}'>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Uplaod</title>
    <style>
        .failed {
            color: red;
        }

        .success {
            color: green;
        }

        .image {
            height: 300px;
            width: auto;
        }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <label for="">Upload a image</label><br>
        <input type="file" name="image_file"><br><br>
        <button type="submit" name="submit">Upload</button>
    </form>
    <?= $msg ?? "" ?>
    <?= $img_HTML ?? "" ?>
</body>

</html>