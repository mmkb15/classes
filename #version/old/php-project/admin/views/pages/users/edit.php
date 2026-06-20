
<?php
require_once 'models/user.class.php';
require_once 'models/role.class.php';


$roles = Role::readAll();
if(isset($_GET['id'])){
  $row = User::readByID($_GET['id']);
  // $id = $_GET['id'];
  // echo '<pre>';
  // print_r($row);
  // echo '</pre>';
  if(!$row){
    $not_found = true;
  }
}else {
  // header("Location: users");
  echo "<script>window.location='users';</script>";
}


// echo '<pre>';
// print_r($roles);
// echo '</pre>';

if(isset($_POST['btn-submit'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role_ID = $_POST['role_ID'];

  // echo $id . $name .  " " . $email. " " . $role_ID ;
  $user = new User($id, $name, $email, $role_ID);
  $user->update();


}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Users</h1>
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
        <a href="users" class="btn-sm btn-dark px-4 py-2 mb-3 d-inline-block">&leftarrow; Back</a>
        <div class="row">
          <div class="col-12">

            <div class="card card-primary">
              <?=  $msg ?? ""; ?>
                <!-- form start -->
                <?php if(isset($not_found)) : ?>
                  <h5>Data Not Found</h5>
                <?php else : ?>
                  <form method="POST">
                    <input type="hidden" value="<?= $row['id']; ?>" name="id">
                      <div class="card-body">
                          <div class="form-group">
                              <label for="name_ID">Name</label>
                              <input type="text" name="name" class="form-control" id="name_ID" value="<?= $row['name'];?>" >
                          </div>
                          <div class="form-group">
                              <label for="email_ID">Email address</label>
                              <input type="email" name="email" class="form-control" id="email_ID" value="<?= $row['email'];?>" >
                          </div>
                          <div class="form-group">
                              <label for="role_ID">Role</label>
                              <select class="form-control" name="role_ID" id="role_ID">
                                <?php foreach($roles as $role) : 
                                  $selected = $role['id'] == $row['role_id'] ? 'selected' : '';  
                                ?>
                                  
                                  <option value="<?= $role['id'] ?>" <?= $selected; ?> ><?= $role['name'] ?></option>
                                <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="pass_ID">Password</label>
                              <input type="password" name="pass" class="form-control" id="pass_ID" placeholder="Password">
                          </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                      <button type="submit" name="btn-submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>
                <?php endif; ?>
            </div>

          </div> 
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


