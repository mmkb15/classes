<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];

    if($page == 'dashboard'){
        include_once('views/pages/dashboard.php');
    } 
    elseif($page == 'form' || $page == 'form.php'){
        include_once('views/pages/form.php');
    }
    elseif($page == 'users'){
        include_once('views/pages/users/manage.php');
    }
    elseif($page == 'create-user'){
        include_once('views/pages/users/create.php');
    }
    elseif($page == 'edit-user'){
        include_once('views/pages/users/edit.php');
    }
    elseif($page == 'products'){
        include_once('views/pages/products/manage.php');
    }
    elseif($page == 'create-product'){
        include_once('views/pages/products/create.php');
    }
    elseif($page == 'pos'){
        include_once('views/pages/pos.php');
    }
    else{
        include_once('views/pages/dashboard.php');
    }
}else{
        include_once('views/pages/dashboard.php');
}

?>