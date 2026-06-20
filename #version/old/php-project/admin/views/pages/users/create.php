
<?php
require_once 'models/user.class.php';
require_once 'models/role.class.php';


$roles = Role::readAll();

// echo '<pre>';
// print_r($roles);
// echo '</pre>';

if(isset($_POST['btn-submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role_ID = $_POST['role_ID'];
  $pass = $_POST['pass'];
  $con_pass = $_POST['con_pass'];

  // echo $name . $email . $role_ID . $pass . $con_pass;

  if($pass == $con_pass){
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $user = new User(null, $name, $email, $role_ID, $pass);
    $res = $user->create();
    if($res === true){
      $msg = "<h3 style='color:green'> User Created Successfully<h3>";
    }else{
      $msg = $res;
    }

    // if($res == true) {
    //   $msg = "$res";
    // } else {
    //   $msg = $res;
    // }


  }else{
    $msg = "password dosen't match";
  }
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Users</h1>
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
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_ID">Name</label>
                            <input type="text" name="name" class="form-control" id="name_ID" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="email_ID">Email address</label>
                            <input type="email" name="email" class="form-control" id="email_ID" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="role_ID">Role</label>
                            <select class="form-control" name="role_ID" id="role_ID">
                              <?php foreach($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pass_ID">Password</label>
                            <input type="password" name="pass" class="form-control" id="pass_ID" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="con_pass_ID">Confirm Password</label>
                            <input type="password"  name="con_pass" class="form-control" id="con_pass_ID" placeholder="Confirm Password">
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


