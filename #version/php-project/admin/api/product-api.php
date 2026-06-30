<?php

function getProducts($id) {
   // echo "function working";

   if($id == 0){
      echo json_encode(Product::readAll($id));   
   }
   else{
      echo json_encode(Product::readAllFilter($id));
   }
}
function getProductsById() {
    
}


?>