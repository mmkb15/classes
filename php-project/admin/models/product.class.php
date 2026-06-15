<?php

class Product
{
    public $id;
    public $name;
    public $brand_id;
    public $category_id;
    public $price;
    public $quantity;
    public $point_of_restock;
    public $is_active;
    public $image;
    public $short_description;

    public function __construct($_id, $_name, $_brand_id, $_category_id, $_price, $_quantity, $_point_of_restock, $_is_active, $_image = null, $_short_description = null ) {
        $this->id = $_id;
        $this->name = $_name;
        $this->brand_id = $_brand_id;
        $this->category_id = $_category_id;
        $this->price = $_price;
        $this->quantity = $_quantity;
        $this->point_of_restock = $_point_of_restock;
        $this->is_active = $_is_active;
        $this->image = $_image;
        $this->short_description = $_short_description;

 

    }
    public function create() {
        global $db;
        $sql = "INSERT INTO products (
                name,
                brand_id,
                category_id,
                price,
                quantity,
                point_of_restock,
                is_active,
                image,
                short_description
            ) VALUES (
                '$this->name',
                '$this->brand_id',
                '$this->category_id',
                '$this->price',
                '$this->quantity',
                '$this->point_of_restock',
                '$this->is_active',
                '$this->image',
                '$this->short_description'
            )";

            $db->query($sql);

            if ($db->error) {
                return $db->error;
            } else {
                return true;
            }
    }



    
    

    public function update(){
        // global $db;
        // $sql = "UPDATE users SET name='$this->name', email = '$this->email', role_id= '$this->role_id' WHERE  id= $this->id";

        // $db->query($sql);
        // if($db->error){
        //     return $db->error;
        // }else{
        //     return true;
        // }

    }
    static public function readAll(){
    //     global $db;
    //     $sql = "SELECT id, name, email FROM users order by id desc";
    //     $result = $db->query($sql);
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }
    // static public function readByID($_id){
    //     global $db;
    //     $sql = "SELECT id, name, email, role_id FROM users WHERE id = $_id";
    //     $result = $db->query($sql);
    //     return $result->fetch_assoc();  //ekta single row return kore

    }
    static public function delete($_id){
        // global $db;
        // $db->query("DELETE FROM  users WHERE id = $_id");

        // if($db->error){
        //     return $db->error;
        // }else{
        //     return true;
        // }
    }

}




?>