<?php
require_once 'models/billing.class.php';

/**
 * Handle Delete Request
 */
if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $res = Billing::delete($id);

    if($res === true){
        $msg = "Bill deleted successfully!";
    } else {
        $msg = $res;
    }
}

/**
 * Get all bills
 */
$billings = Billing::readAll();
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Billing List</h3>
    </div>

    <!-- Display Message -->
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
                <a href="create-billing" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" mb-4 style="padding: 1.5px 13px;">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block fs-18 position-relative top-1"></i>
                        <span>Generate New Bill</span>
                    </span>
                </a>
            </div>

            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Bill ID</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Admission ID</th>
                                <th scope="col">Amount (BDT)</th>
                                <th scope="col">Bill Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($billings as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                <td><?= $row['admission_id'] ?? 'N/A' ?></td>
                                <td><?= number_format($row['amount'], 2) ?></td>
                                <td><?= date('d M, Y', strtotime($row['bill_date'])) ?></td>
                                <td><?= htmlspecialchars($row['description'] ?? '') ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <!-- View Button -->
                                        <a href="?page=billings/view&id=<?= $row['id'] ?>" 
                                           class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                           title="View Bill">
                                            <i class="material-symbols-outlined fs-18 text-primary">visibility</i>
                                        </a>
                                        <!-- Print Button -->
                                        <a href="?page=billings/print&id=<?= $row['id'] ?>" 
                                           target="_blank" 
                                           class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                           title="Print Bill">
                                            <i class="material-symbols-outlined fs-18 text-success">print</i>
                                        </a>
                                        <!-- Edit Button (যোগ করা হলো) -->
                                        <a href="?page=billings/edit&id=<?= $row['id'] ?>" 
                                           class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                           title="Edit Bill">
                                            <i class="material-symbols-outlined fs-18 text-body">edit</i>
                                        </a>
                                        <!-- Delete Button -->
                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                            <button type="submit" 
                                                    class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                                    onclick="return confirm('Are you sure you want to delete this bill?')"
                                                    title="Delete Bill">
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
                    <span class="fs-12 fw-medium">Showing <?= count($billings) ?> of <?= count($billings) ?> Results</span>
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