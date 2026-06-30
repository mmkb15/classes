<?php
class Order
{
  public function create($_cart)
  {
    global $db;
    $db->query("INSERT INTO orders (customer_id,user_id) VALUES (1,1)");
    $order_id = $db->insert_id;
    foreach ($_cart as $item) {
        // print_r($item->id);
        $db->query("INSERT INTO order_details (order_id,product_id,qty,price) 
        VALUES ($order_id, $item->id, $item->quantity, $item->price)");
    }
  }
}
