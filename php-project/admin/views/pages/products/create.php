<?php
require_once 'helpers/img-upload-helper.php';
require_once 'models/product.class.php';
require_once 'models/category.class.php';
require_once 'models/brand.class.php';

$categories = Category::readAll();
$brands = Brand::readAll();
// echo '<pre>';
// print_r($roles);
// echo '</pre>';

if(isset($_POST['btn_submit'])){
  $name               = $_POST['name'];
  $category_id        = $_POST['category_id'];
  $brand_id           = $_POST['brand_id'];
  $price              = $_POST['price'];
  $quantity           = $_POST['qty'];
  $point_of_restock   = $_POST['restock'];
  $active             = isset($_POST['active']) ? 1 : 0;
  $short_description  = $_POST['desc'];

  // print_r($_FILES['image']);
  $file = isset($_FILES['image']) ? $_FILES['image'] : [];
  $image = imgUpload($file);
  // print_r($image);
  if(isset($image['error'])){
    $msg = $image['error'];
  }else{
    $image_path = $image['success'];
    $product = new Product(null, $name, $category_id, $brand_id, $price, $quantity, $point_of_restock, $active, $image_path, $short_description);
    $product->create();
    $msg = "Product created successfully";
  }
  // echo $active;

  // $product = new Product(null, $name, $category_id, $brand_id, $price, $quantity, $point_of_restock, $active, null, $short_description);
  // $product->create();
  // $msg = "Product created successfully";
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="products" class="btn btn-sm btn-dark">&leftarrow; Back</a>
        <div class="row">
          <div class="col-12">
            <h4><?= $msg ?? "" ?></h4>
            <div class="card card-primary">
              <!-- form start -->
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                      <?php foreach($categories as $item): ?>
                      <option value="<?php echo $item['id']; ?>"> <?php echo $item['name']; ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control" name="brand_id">
                      <?php foreach($brands as $item): ?>
                      <option value="<?php echo $item['id']; ?>"> <?php echo $item['name']; ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Short Description</label>
                    <input type="text" class="form-control" name="desc">
                  </div>                
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price">
                  </div>                
                  <div class="form-group">
                    <label>QTY</label>
                    <input type="number" class="form-control" name="qty">
                  </div>                
                  <div class="form-group">
                    <label>Point of Restock</label>
                    <input type="number" class="form-control" name="restock" value="0">
                  </div>                
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image">
                  </div>                
                  <div class="form-group">
                    <input type="checkbox" name="active" value="1">
                    <label>Is Active</label>
                  </div>                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>