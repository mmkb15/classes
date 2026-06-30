<?php
require_once 'models/test.class.php';

/**
 * Handle Delete Request
 */
if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $res = Test::delete($id);

    if($res === true){
        $msg = "Test deleted successfully!";
    } else {
        $msg = $res;
    }
}

/**
 * Get all tests
 */
$tests = Test::readAll();
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Test List</h3>
    </div>

    <!-- Display Success/Error Message -->
    <?php if(isset($msg)): ?>
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <?php echo $msg ?? "" ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">

            <!-- Add Button -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-20">
                <a href="create-test" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" mb-4 style="padding: 1.5px 13px;">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block fs-18 position-relative top-1"></i>
                        <span>Add New Test</span>
                    </span>
                </a>
            </div>

            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Test Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price (BDT)</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tests as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td><?= $row['price'] ?></td>
                                <td><?= date('d M, Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <!-- Edit Button -->
                                        <a href="?page=tests/edit&id=<?= $row['id'] ?>">
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <i class="material-symbols-outlined fs-18 text-body">edit</i>
                                            </button>
                                        </a>

                                        <!-- Delete Button -->
                                        <form method="POST">
                                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                            <button type="submit" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" onclick="return confirm('Are you sure you want to delete this test?')">
                                                <i class="material-symbols-outlined fs-18 text-danger">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                    <span class="fs-12 fw-medium">Showing <?= count($tests) ?> of <?= count($tests) ?> Results</span>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0 justify-content-center">
                            <li class="page-item"><button class="page-link active">1</button></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>