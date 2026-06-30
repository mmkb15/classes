<?php
function getProducts($id) {
    // echo "function working";
    // Product::readAllFilter(10);
    if($id == 0) {
        echo json_encode(Product::readAll());
    }else{
        echo json_encode(Product::readAllFilter($id));
    }
}
function getProductById() {
}

?>