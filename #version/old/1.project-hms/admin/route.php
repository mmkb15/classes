<?php

if(isset($_GET['page'])){
    $page = $_GET['page'];

    if($page == 'dashboard' || $page == 'dashboard.php'){
        include_once 'views/pages/dashboard.php';
    }
    elseif($page == 'form' || $page == 'form.php'){
        include_once 'views/pages/form.php';
    }
    elseif($page == 'table' || $page == 'table.php'){
        include_once 'views/pages/table.php';
    }
    else{
        include_once 'views/pages/dashboard.php';
    }
}
else{
        include_once 'views/pages/dashboard.php';
    }


?>