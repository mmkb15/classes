<?php
require_once("../config/db.php");
foreach (glob("../models/*.class.php") as $filename) {
    require_once $filename;
}

foreach (glob("*-api.php") as $filename) {
    require_once $filename;
}


if(isset($_GET['endpoint'])) {
    $api_route =  $_GET['endpoint'];
    if($api_route == 'get-products'){
        // echo $_GET['id'];
        getProducts($_GET['id']);
        // echo "api data";
    }
    // elseif($api_route == 'test') {
    // echo "test api";
    // }
}
?>