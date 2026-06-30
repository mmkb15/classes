<?php
// =============================================
// DASHBOARD STATISTICS - ALL MODULES
// =============================================

// Core Counts
$total_patients   = $db->query("SELECT COUNT(*) AS count FROM patients")->fetch_assoc()['count'];
$total_doctors    = $db->query("SELECT COUNT(*) AS count FROM doctors")->fetch_assoc()['count'];
$total_appointments = $db->query("SELECT COUNT(*) AS count FROM appointments")->fetch_assoc()['count'];
$total_prescriptions = $db->query("SELECT COUNT(*) AS count FROM prescriptions")->fetch_assoc()['count'];
$total_admissions = $db->query("SELECT COUNT(*) AS count FROM admissions")->fetch_assoc()['count'];
$total_medicines  = $db->query("SELECT COUNT(*) AS count FROM medicines")->fetch_assoc()['count'];
$total_tests      = $db->query("SELECT COUNT(*) AS count FROM tests")->fetch_assoc()['count'];
$total_bills      = $db->query("SELECT COUNT(*) AS count FROM billings")->fetch_assoc()['count'];

// Today's Appointments
$today = date('Y-m-d');
$today_appointments = $db->query("SELECT COUNT(*) AS count FROM appointments WHERE appointment_date = '$today'")->fetch_assoc()['count'];

// Active Admissions (Admitted)
$active_admissions = $db->query("SELECT COUNT(*) AS count FROM admissions WHERE status = 'Admitted'")->fetch_assoc()['count'];

// Pending Appointments (Scheduled)
$pending_appointments = $db->query("SELECT COUNT(*) AS count FROM appointments WHERE status = 'Scheduled'")->fetch_assoc()['count'];

// Recent Appointments (Last 5)
$recent_appointments = $db->query("
    SELECT a.*, p.name AS patient_name, d.name AS doctor_name 
    FROM appointments a
    LEFT JOIN patients p ON a.patient_id = p.id
    LEFT JOIN doctors d ON a.doctor_id = d.id
    ORDER BY a.id DESC LIMIT 5
")->fetch_all(MYSQLI_ASSOC);

// Recent Admissions (Last 5)
$recent_admissions = $db->query("
    SELECT a.*, p.name AS patient_name, r.room_no 
    FROM admissions a
    LEFT JOIN patients p ON a.patient_id = p.id
    LEFT JOIN rooms r ON a.room_id = r.id
    ORDER BY a.id DESC LIMIT 5
")->fetch_all(MYSQLI_ASSOC);
?>

<div class="main-content-container overflow-hidden">

    <!-- ==========================================
    WELCOME SECTION
    ========================================== -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-primary bg-opacity-10 border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1">Welcome to City Hospital Dashboard</h3>
                            <p class="text-secondary mb-0">
                                Today is <strong><?= date('l, d M Y') ?></strong> | 
                                You have <strong><?= $today_appointments ?></strong> appointments today.
                            </p>
                        </div>
                        <div class="d-flex gap-2 mt-2 mt-sm-0">
                            <a href="?page=patients/create" class="btn btn-primary py-2 px-4 fw-medium fs-14">
                                <i class="material-symbols-outlined fs-18 me-1">add</i> New Patient
                            </a>
                            <a href="?page=appointments/create" class="btn btn-outline-primary py-2 px-4 fw-medium fs-14">
                                <i class="material-symbols-outlined fs-18 me-1">add</i> New Appointment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ==========================================
STATISTICS CARDS - ROW 1 (Core Modules)
========================================== -->
<div class="row">
    <!-- Patients -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(73, 54, 245, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Patients</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_patients) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(73, 54, 245, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #4936f5;">group</i>
                    </div>
                </div>
                <a href="?page=patients/manage" class="fs-12 text-primary text-decoration-none mt-2 d-inline-block">View All →</a>
            </div>
        </div>
    </div>

    <!-- Doctors -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(10, 143, 74, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Doctors</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_doctors) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(10, 143, 74, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #0a8f4a;">medical_services</i>
                    </div>
                </div>
                <a href="?page=doctors/manage" class="fs-12 text-primary text-decoration-none mt-2 d-inline-block">View All →</a>
            </div>
        </div>
    </div>

    <!-- Appointments -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(0, 131, 143, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Appointments</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_appointments) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(0, 131, 143, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #00838f;">calendar_month</i>
                    </div>
                </div>
                <a href="?page=appointments/manage" class="fs-12 text-primary text-decoration-none mt-2 d-inline-block">View All →</a>
            </div>
        </div>
    </div>

    <!-- Prescriptions -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(249, 168, 37, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Prescriptions</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_prescriptions) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(249, 168, 37, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #f9a825;">clinical_notes</i>
                    </div>
                </div>
                <a href="?page=prescriptions/manage" class="fs-12 text-primary text-decoration-none mt-2 d-inline-block">View All →</a>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
STATISTICS CARDS - ROW 2 (Extended Modules)
========================================== -->
<div class="row">
    <!-- Admissions -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(217, 48, 37, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Admissions</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_admissions) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(217, 48, 37, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #d93025;">bed</i>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="badge-status badge-status-admitted"><?= $active_admissions ?> Active</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Medicines -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(108, 117, 125, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Medicines</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_medicines) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(108, 117, 125, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #6c757d;">vaccines</i>
                    </div>
                </div>
                <a href="?page=medicines/manage" class="fs-12 text-primary text-decoration-none mt-2 d-inline-block">View All →</a>
            </div>
        </div>
    </div>

    <!-- Tests -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(111, 66, 193, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Tests</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_tests) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(111, 66, 193, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #6f42c1;">science</i>
                    </div>
                </div>
                <a href="?page=tests/manage" class="fs-12 text-primary text-decoration-none mt-2 d-inline-block">View All →</a>
            </div>
        </div>
    </div>

    <!-- Bills -->
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 rounded-3 mb-4" style="background: rgba(0, 150, 136, 0.08);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block fs-12 fw-medium text-body-color-50 mb-2">Total Bills</span>
                        <h3 class="mb-0 fs-24 fw-semibold"><?= number_format($total_bills) ?></h3>
                    </div>
                    <div class="wh-50 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(0, 150, 136, 0.15);">
                        <i class="material-symbols-outlined fs-24" style="color: #009688;">receipt_long</i>
                    </div>
                </div>
                <a href="?page=billings/manage" class="fs-12 text-primary text-decoration-none mt-2 d-inline-block">View All →</a>
            </div>
        </div>
    </div>
</div>

    <!-- ==========================================
    STATUS SUMMARY ROW
    ========================================== -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-20">
                    <h4 class="fs-16 fw-semibold mb-3">Appointments Summary</h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge-status badge-status-scheduled" style="min-width:20px;">&nbsp;</span>
                                <span>Scheduled: <strong><?= $pending_appointments ?></strong></span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge-status badge-status-completed" style="min-width:20px;">&nbsp;</span>
                                <span>Completed: <strong><?= $total_appointments - $pending_appointments ?></strong></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge-status badge-status-cancelled" style="min-width:20px;">&nbsp;</span>
                                <span>Cancelled: <strong><?= $total_appointments - $pending_appointments ?></strong></span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge-status badge-status-admitted" style="min-width:20px;">&nbsp;</span>
                                <span>Active Admissions: <strong><?= $active_admissions ?></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-20">
                    <h4 class="fs-16 fw-semibold mb-3">Quick Actions</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="?page=patients/create" class="btn btn-outline-primary py-2 px-3 fw-medium fs-14">
                            <i class="material-symbols-outlined fs-18 me-1">person_add</i> Add Patient
                        </a>
                        <a href="?page=doctors/create" class="btn btn-outline-success py-2 px-3 fw-medium fs-14">
                            <i class="material-symbols-outlined fs-18 me-1">medical_services</i> Add Doctor
                        </a>
                        <a href="?page=appointments/create" class="btn btn-outline-info py-2 px-3 fw-medium fs-14">
                            <i class="material-symbols-outlined fs-18 me-1">calendar_month</i> New Appointment
                        </a>
                        <a href="?page=prescriptions/create" class="btn btn-outline-warning py-2 px-3 fw-medium fs-14">
                            <i class="material-symbols-outlined fs-18 me-1">clinical_notes</i> Write Prescription
                        </a>
                        <a href="?page=admissions/create" class="btn btn-outline-danger py-2 px-3 fw-medium fs-14">
                            <i class="material-symbols-outlined fs-18 me-1">bed</i> Admit Patient
                        </a>
                        <a href="?page=billings/create" class="btn btn-outline-secondary py-2 px-3 fw-medium fs-14">
                            <i class="material-symbols-outlined fs-18 me-1">receipt_long</i> Generate Bill
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
    RECENT ACTIVITY - 2 COLUMN LAYOUT
    ========================================== -->
    <div class="row">
        <!-- Recent Appointments -->
        <div class="col-xl-6">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-20">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-20">
                        <h4 class="mb-0 fs-16 fw-semibold">Recent Appointments</h4>
                        <a href="?page=appointments/manage" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" style="padding: 1.5px 13px;">
                            <span class="py-sm-1 d-block">View All</span>
                        </a>
                    </div>
                    <div class="default-table-area">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Patient</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($recent_appointments) > 0): ?>
                                        <?php foreach ($recent_appointments as $row): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                            <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                                            <td><?= date('d M, Y', strtotime($row['appointment_date'])) ?></td>
                                            <td>
                                                <span class="badge-status <?= $row['status'] == 'Scheduled' ? 'badge-status-scheduled' : ($row['status'] == 'Completed' ? 'badge-status-completed' : 'badge-status-cancelled') ?>">
                                                    <?= $row['status'] ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4" class="text-center text-muted">No appointments found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Admissions -->
        <div class="col-xl-6">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-20">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-20">
                        <h4 class="mb-0 fs-16 fw-semibold">Recent Admissions</h4>
                        <a href="?page=admissions/manage" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" style="padding: 1.5px 13px;">
                            <span class="py-sm-1 d-block">View All</span>
                        </a>
                    </div>
                

                    <div class="default-table-area">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Patient</th>
                                        <th scope="col">Room</th>
                                        <th scope="col">Admit Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($recent_admissions) > 0): ?>
                                        <?php foreach ($recent_admissions as $row): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                            <td><?= $row['room_no'] ?></td>
                                            <td><?= date('d M, Y', strtotime($row['admit_date'])) ?></td>
                                            <td>
                                                <span class="badge-status <?= $row['status'] == 'Admitted' ? 'badge-status-admitted' : 'badge-status-discharged' ?>">
                                                    <?= $row['status'] ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4" class="text-center text-muted">No admissions found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>