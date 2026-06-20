
<?php
require_once 'models/product.class.php';

if(isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  $res = User::delete($id);

  if($res === true){
      $msg = "User Deleted Successfully";
    }else{
      $msg = $res;
    }
}


$rows = Product::readAll();
echo '<pre>';
print_r($rows);
echo '</pre>';

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
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
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="create-products" class="btn btn-dark">Create Prodcut</a>

                <?php if(isset($msg)) : ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  <?=  $msg ?? "" ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
              <?php endif;  ?>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <!-- <th>Image</th> -->
                            <th>Price</th>
                            <th>QTY</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($rows as $item) : ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= $item['brand'] ?></td>
                            <td><?= $item['category'] ?></td>
                            <td><?= $item['is_active'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"><i class="fa fa-eye text-primary"></i></button>
                                    <a href="edit-user?id=<?= $item['id']; ?>"><button type="button" class="btn btn-default"><i class="fa fa-edit text-success"></i></button></a>
                                    <form method="POST">
                                      <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    </table>
                </div>       
                
              </div>
              <!-- /.card-body -->
            <!-- /.card -->


          </div>
          
        </div>


        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


