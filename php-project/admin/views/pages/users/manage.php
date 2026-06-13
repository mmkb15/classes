
<?php
require_once 'models/user.class.php';
$rows = User::readAll();
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
            <h1>Users</h1>
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
                <a href="" class="btn btn-sm btn-dark">Create User</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($rows as $item) : ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"><i class="fa fa-eye text-primary"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-edit text-success"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-trash text-danger"></i></button>
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


