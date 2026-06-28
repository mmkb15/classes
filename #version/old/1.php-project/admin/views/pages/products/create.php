
<?php
require_once 'models/product.class.php';
require_once 'models/brand.class.php';
require_once 'models/category.class.php';


$brands = Brand::readAll();
$category = Category::readAll();

// echo '<pre>';
// print_r($roles);
// echo '</pre>';



if (isset($_POST['btn-submit'])) {

    $name         = $_POST['name'];
    $brand_id     = $_POST['brand_id'];
    $category_id  = $_POST['category_id'];
    $price        = $_POST['price'];
    $qty          = $_POST['qty'];
    $restock      = $_POST['restock'];
    $short_desc      = $_POST['short_desc'];

    // Checkbox value
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // File upload
    // $image = $_FILES['image']['name'] ?? '';

    echo "Name: " . $name . "<br>";
    echo "Brand id: " . $brand_id . "<br>";
    echo "Category id: " . $category_id . "<br>";
    echo "Price: " . $price . "<br>";
    echo "Quantity: " . $qty . "<br>";
    echo "Restock Point: " . $restock . "<br>";
    echo "short_desc: " . $short_desc . "<br>";
    // echo "Image: " . $image . "<br>";
    echo "Is Active: " . $is_active . "<br>";

    $product = new Product(null, $name, $brand_id, $category_id, $price, $qty, $restock, $is_active );
    $product->create();

}


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="products" class="btn-sm btn-dark px-4 py-2 mb-3 d-inline-block">&leftarrow; Back</a>
        <div class="row">
          <div class="col-12">

            <div class="card card-primary">
              <?=  $msg ?? ""; ?>
                <!-- form start -->
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_id">Name</label>
                            <input type="text" name="name" class="form-control" id="name_id">
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                              <?php foreach($brands as $item) :  ?>
                                <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" name="category_id" id="category_id">
                              <?php foreach($category as $item) :  ?>
                                <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" id="price">
                        </div>
                         <div class="form-group">
                            <label for="qty">QTY</label>
                            <input type="text" name="qty" class="form-control" id="qty">
                        </div>
                         <div class="form-group">
                            <label for="restock">Point of Restock</label>
                            <input type="text" name="restock" class="form-control" id="restock">
                        </div>
                        <div class="form-group">
                           <label for="short_desc">Short Description</label>
                           <input type="text" name="short_desc" class="form-control" id="short_desc">
                       </div>
                        <div class="form-group">
                          <label for="image">Image</label>
                          <input type="file" name="image"  id="image">
                        </div>
                        <div class="form-group">
                          <label for="image">Is Active</label>
                          <input type="checkbox" name="is_active" value="is_active">
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" name="btn-submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

          </div> 
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


