<?php
$currentPage = $currentPage ?? '';
?>
<!-- Sidebar -->
<div class="sidebar-area" id="sidebar">
    <div class="logo-area">
        <a href="<?= BASE_URL_ADMIN ?>index.php" class="logo-text">
            <i class="fas fa-hospital-alt" style="color:#3584fc;font-size:24px;"></i>
            <span style="font-weight:700;font-size:16px;color:#1a1a2e;margin-left:8px;">HMS</span>
        </a>
        <button class="sidebar-toggle d-lg-none" id="sidebarToggle">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="sidebar-menu" data-simplebar>
        <ul class="sidebar-nav">

            <!-- Dashboard -->
            <li class="sidebar-item <?= $currentPage == 'dashboard' ? 'active' : '' ?>">
                <a href="<?= BASE_URL_ADMIN ?>index.php" class="sidebar-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Patients -->
            <li class="sidebar-item <?= $currentPage == 'patients' ? 'active' : '' ?>">
                <a href="<?= BASE_URL_ADMIN ?>views/pages/patients/index.php" class="sidebar-link">
                    <i class="fas fa-procedures"></i>
                    <span>Patients</span>
                </a>
            </li>

            <!-- Doctors -->
            <li class="sidebar-item <?= $currentPage == 'doctors' ? 'active' : '' ?>">
                <a href="<?= BASE_URL_ADMIN ?>views/pages/doctors/index.php" class="sidebar-link">
                    <i class="fas fa-user-md"></i>
                    <span>Doctors</span>
                </a>
            </li>

            <!-- Appointments -->
            <li class="sidebar-item <?= $currentPage == 'appointments' ? 'active' : '' ?>">
                <a href="<?= BASE_URL_ADMIN ?>views/pages/appointments/index.php" class="sidebar-link">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>
            </li>

            <!-- Reports -->
            <li class="sidebar-item <?= $currentPage == 'reports' ? 'active' : '' ?>">
                <a href="<?= BASE_URL_ADMIN ?>views/pages/reports/index.php" class="sidebar-link">
                    <i class="fas fa-file-medical"></i>
                    <span>Reports</span>
                </a>
            </li>

            <li class="sidebar-divider"></li>

            <!-- Logout -->
            <li class="sidebar-item">
                <a href="<?= BASE_URL_ADMIN ?>logout.php" class="sidebar-link text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
    </div>
</div>

<!-- Main Content Wrapper -->
<div class="main-content" id="mainContent">
    <!-- Top Navbar -->
    <div class="top-navbar no-print">
        <div class="d-flex align-items-center gap-3">
            <button class="sidebar-toggle-btn" onclick="document.getElementById('sidebar').classList.toggle('active')">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="mb-0" style="font-weight:600;color:#1a1a2e;"><?= $pageTitle ?? 'Dashboard' ?></h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span style="color:#666;font-size:14px;">
                <i class="fas fa-user-circle"></i>
                <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?>
            </span>
        </div>
    </div>

    <!-- Page Content Start -->
    <div class="page-content">
