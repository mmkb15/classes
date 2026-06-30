<?php
class Product
{
  public $id;
  public $name;
  public $category_id;
  public $brand_id;
  public $short_description;
  public $price;
  public $quantity;
  public $point_of_restock;
  public $image;
  public $active;
  
  static public function allProducts()
  {
    global $db;
    $sql = "SELECT p.id, p.name, p.price, p.quantity, b.name as brand, c.name as category, p.image 
    FROM products p, brands b, categories c
    WHERE p.brand_id = b.id AND p.category_id = c.id AND p.active = 1
    ORDER BY id DESC
    LIMIT 8";

    $result = $db->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  static public function productById($_id)
  {
    global $db;
    $sql = "SELECT p.id, p.name, p.price, p.quantity, b.name as brand, c.name as category, p.image 
    FROM products p, brands b, categories c
    WHERE p.brand_id = b.id AND p.category_id = c.id AND p.id = $_id";
    $result = $db->query($sql);
    return $result->fetch_assoc();
  }
}
