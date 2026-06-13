<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];

    if($page == 'dashboard' ||  $page == 'dashboard.php'){
        include_once('views/pages/dashboard.php');

    } 
    elseif($page == 'form' || $page == 'form.php'){
        include_once('views/pages/form.php');

    } 
    elseif($page == 'table' || $page == 'table.php'){
        include_once('views/pages/table.php');

    }
    elseif($page == 'users'){
        include_once('views/pages/users/manage.php');
        
    }
    elseif($page == 'create-user'){
        include_once('views/pages/users/create.php');
        
    }
    else{
        include_once('views/pages/dashboard.php');
    }
}
    else{
        include_once('views/pages/dashboard.php');
    }



?>