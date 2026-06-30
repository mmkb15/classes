<?php
require_once 'models/user.class.php';
require_once 'models/role.class.php';

if(isset($_POST['btn_submit'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role_id = $_POST['role_id'];
  // echo $name . " " . $email . " " . $role_id;
  $user = new User($id, $name, $email, $role_id);
  $user->update();  
}

$roles = Role::readAll();
if(isset($_GET['id'])){
  $row = User::readById($_GET['id']);
  // echo '<pre>';
  // print_r($row);
  // echo '</pre>';
  // if(!$item){
  //   $not_found = true;
  // }
}
// else{
//   echo "<script>window.location='users';</script>";
//   exit;
// }


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="users" class="btn btn-sm btn-dark">&leftarrow; Back</a>
        <div class="row">
          <div class="col-12">
            <h4><?= $msg ?? "" ?></h4>
            <div class="card card-primary">
              <!-- form start -->
              <?php if(isset($not_found)): ?>
               <h5>Data not found.</h5>
              <?php else: ?>
              <form action="" method="POST">
                <input type="hidden" value="<?= $row['id']; ?>" name="id">
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?= $row['name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?= $row['email']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role_id">
                      <?php foreach($roles as $item) { 
                      $selected = $item['id'] == $row['role_id'] ? 'selected' : '';
                      ?>                      
                      <option value="<?= $item['id']; ?>" <?= $selected; ?> ><?= $item['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body --> 
                <div class="card-footer">
                  <button type="submit" name="btn_submit" class="btn btn-primary">Update</button>
                </div>
              </form>
              <?php endif; ?>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>