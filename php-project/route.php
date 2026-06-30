<?php
if(isset($_GET['page']))
{
    $page = $_GET['page'];
    if(file_exists("views/pages/$page.php"))
    {
        include_once "views/pages/$page.php";
    }else{
        include_once "views/pages/404.php";
    }
}
else
{
    include_once "views/pages/home.php";
}

?>