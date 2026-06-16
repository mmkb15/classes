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

  public function __construct($_id, $_name, $_category_id, $_brand_id, $_price, $_quantity, $_point_of_restock, $_active, $_image = null, $_short_description = null)
  {
    $this->id                 = $_id;
    $this->name               = $_name;
    $this->category_id        = $_category_id;
    $this->brand_id           = $_brand_id;
    $this->short_description  = $_short_description;
    $this->price              = $_price;
    $this->quantity           = $_quantity;
    $this->point_of_restock   = $_point_of_restock;
    $this->image              = $_image;
    $this->active             = $_active;
  }

  public function create()
  {
    global $db;
    $sql = "INSERT INTO products (
                id,
                name,
                category_id,
                brand_id,
                price,
                quantity,
                point_of_restock,
                active,
                image,
                short_description
            ) VALUES (
                '$this->id',
                '$this->name',
                $this->category_id,
                $this->brand_id,
                $this->price,
                $this->quantity,
                $this->point_of_restock,
                $this->active,
                " . ($this->image ? "'$this->image'" : "NULL") . ",
                " . ($this->short_description ? "'$this->short_description'" : "NULL") . "
            )";

    $db->query($sql);

    if ($db->error) {
      return $db->error;
    } else {
      return true;
    }
  }
  public function update() {}
  static public function readAll()
  {
    global $db;
    $sql = "SELECT p.id, p.name, p.price, p.quantity, b.name as brand, c.name as category, p.active, p.image 
    FROM products p, brands b, categories c
    WHERE p.brand_id = b.id AND p.category_id = c.id  
    ORDER BY id DESC";

    $result = $db->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  static public function readById($_id)
  {
    global $db;
    $sql = "SELECT id, name, email, role_id FROM users WHERE id = $_id";
    $result = $db->query($sql);
    return $result->fetch_assoc();
  }
  static public function delete($_id)
  {
    global $db;
    $db->query("DELETE FROM users WHERE id = $_id");
    // if($db->affected_rows > 0){
    //   return true;
    // }
    if ($db->error) {
      return $db->error;
    } else {
      return true;
    }
  }
}
