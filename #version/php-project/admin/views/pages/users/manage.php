<?php
require_once 'models/user.class.php';

if(isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  // echo $id;
  $res = User::delete($id);
  if($res === true){
    $msg = "User deleted successfully";
  }else{
    $msg = $res;
  }
}

$limit = 3;

$pages = User::getPageNo($limit);
// echo '<pre>';
// print_r($pages);
// echo '</pre>';
$rows = User::readAll(1, $limit);
// echo '<pre>';
// print_r($rows);
// echo '</pre>';


if(isset($_GET['pg'])) {
  $pg = $_GET['pg'];
  // echo "<h1>Page Number : $pg</h1>";
  $rows = User::readAll($pg, $limit);
}
?>

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
            <li class="breadcrumb-item active">Users</li>
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
          <?php if(isset($msg)): ?>
          <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <?php echo $msg ?? "" ?>
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
          </div>
          <?php endif; ?>
          <div class="card">
            <div class="card-header">
              <a href="create-user" class="btn btn-sm btn-dark">Create User</a>
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
                    <?php foreach ($rows as $item) { ?>
                      <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default"><i class="fa fa-eye text-primary"></i></button>
                            <a href="edit-user?id=<?= $item['id']; ?>" class="btn btn-sm btn-default"><i class="fa fa-edit text-success"></i></a>
                            <form method="POST">
                              <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                              <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-trash text-danger"></i></button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="users?pg=1">«</a></li>

                  <?php for($i = 1; $i <= $pages; $i++): ?>
                  <li class="page-item"><a class="page-link" href="users?pg=<?= $i; ?>"><?= $i ?></a></li>
                  <?php endfor; ?>

                  <li class="page-item"><a class="page-link" href="users?pg=<?= $pages; ?>">»</a></li>
                </ul>
              </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>