
<?php
require_once 'models/doctor.class.php';
require_once 'models/department.class.php';


/* 
  *-------------------------------------------------------------------------
  * Form Submit After Submit
  *-------------------------------------------------------------------------
*/
if(isset($_POST['btn-submit'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $dept_id = $_POST['dept_id'];
  $specialization = $_POST['specialization'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];


  $image_name = null;
  if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
      $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
      $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
      if (in_array($ext, $allowed)) {
          // Delete old image
          if (!empty($row['image']) && file_exists('assets/uploads/doctors/' . $row['image'])) {
              unlink('assets/uploads/doctors/' . $row['image']);
          }
          $image_name = 'doctor_' . time() . '.' . $ext;
          move_uploaded_file($_FILES['image']['tmp_name'], 'assets/uploads/doctors/' . $image_name);
      }
  }

/* 
  *-------------------------------------------------------------------------
  * From doctor Class
  *-------------------------------------------------------------------------
*/
  $doctor = new doctor($id, $dept_id, $name, $specialization, $phone, $email, $image_name);
  $res = $doctor->update();
      if($res === true){
      $msg = "Doctor Update Successfully";
      
    }else{
      $msg = $res;
    }  
}

/* 
  *-------------------------------------------------------------------------
  * From department Class
  *-------------------------------------------------------------------------
*/
  $departments = department::readAll();
      // echo '<pre>';
      // print_r($departments);
      // echo '</pre>';

/* 
  *-------------------------------------------------------------------------
  * From doctor Class
  *-------------------------------------------------------------------------
*/
  if(isset($_GET['id'])){
    $row = doctor::readById($_GET['id']); 
      // echo '<pre>';
      // print_r($row);
      // echo '</pre>';

        if(!$row){  // if data not found
        $not_found = true;
    }
  }

?>


    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Edit doctor</h3>
        </div>

        <!-- Message -->
        <?php if(isset($msg)): ?>
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <?php echo $msg ?? "" ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
       
        <!--Prev Button  -->
        <a href="doctors"><button class="btn btn-secondary py-2 px-4 fw-medium fs-16 mb-3" type="submit" name="btn-submit"> <i class="ri-arrow-left-long-line"></i> Back</button></a>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">

              <?php if(isset($not_found)): ?>
               <h5>Data not found.</h5>
              <?php else: ?>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Doctor Name</label>
                                <input type="text" name="name"  class="form-control h-60 border-border-color" value="<?= $row['name']; ?>"  >
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Specialty</label>
                                <input type="text" name="specialization" class="form-control h-60 border-border-color" value="<?= $row['specialization']; ?>"  >
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Depertment</label>
                                <select class="form-control h-60 border-border-color" name="dept_id">

                                <!-- Department List(Dropdown) -->
                                <?php foreach($departments as $department) : 
                                  $selected = $department['id'] == $row['department_id'] ? 'selected' : '';  
                                ?>
                                  
                                  <option value="<?= $department['id'] ?>"> <?= $department['name'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Phone</label>
                                <input type="number" name="phone" class="form-control h-60 border-border-color" value="<?= $row['phone']; ?>"  >
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Email</label>
                                <input type="email" name="email" class="form-control h-60 border-border-color" value="<?= $row['email'];?>">
                            </div>
                        </div>

                        <!-- Image Block (Edit Page) -->
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="label text-secondary">Add Avatar</label>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-upload mw-100">
                                        <div class="mb-2">
                                            <input type="file" id="imageUpload" class="form-control h-60" accept="image/*" style="padding-top: 18px;" name="image">
                                        </div>
                                        <span class="fs-12 mb-4 d-block">Please upload your image with a size of 135 x 135 (JPG, PNG, GIF, WebP)</span>
                                        <div class="avatar-preview rounded-circle border-0">
                                            <div id="imagePreview" class="rounded-circle" 
                                                style="background-image: url('<?= !empty($row['image']) ? 'assets/uploads/doctors/' . $row['image'] : 'assets/images/doctor_01.png' ?>'); 
                                                        background-size: cover; background-position: center;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <!-- <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> -->
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit"> <i class="ri-add-line text-white fw-medium"></i> Add doctor</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>


