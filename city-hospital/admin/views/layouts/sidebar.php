<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="dashboard" class="d-block text-decoration-none position-relative">
            <img src="assets/images/logo-icon.png" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">City Hospital</span>
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">

            <?php
            // Get current page from URL (e.g., 'dashboard', 'patients', etc.)
            $current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
            ?>

            <!-- ==========================================
            DASHBOARD
            ========================================== -->
            <li class="menu-item <?= ($current_page == 'dashboard') ? 'active' : '' ?>">
                <a href="dashboard" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <!-- ==========================================
            PATIENT MANAGEMENT (Category Label)
            ========================================== -->
            <li class="menu-category">
                <span class="menu-category-text"> | Patient Management</span>
            </li>

            <li class="menu-item <?= ($current_page == 'patients') ? 'active' : '' ?>">
                <a href="patients" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">group</span>
                    <span class="title">Patients</span>
                </a>
            </li>

            <li class="menu-item <?= ($current_page == 'admissions') ? 'active' : '' ?>">
                <a href="admissions" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">bed</span>
                    <span class="title">Admissions</span>
                </a>
            </li>

            <li class="menu-item <?= ($current_page == 'history-search') ? 'active' : '' ?>">
                <a href="history-search" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">history</span>
                    <span class="title">Patient History</span>
                </a>
            </li>

            <!-- ==========================================
            CLINICAL MANAGEMENT (Category Label)
            ========================================== -->
            <li class="menu-category">
                <span class="menu-category-text"> | Clinical Management</span>
            </li>

            <li class="menu-item <?= ($current_page == 'doctors') ? 'active' : '' ?>">
                <a href="doctors" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">medical_services</span>
                    <span class="title">Doctors</span>
                </a>
            </li>

            <li class="menu-item <?= ($current_page == 'appointments') ? 'active' : '' ?>">
                <a href="appointments" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">calendar_month</span>
                    <span class="title">Appointments</span>
                </a>
            </li>

            <li class="menu-item <?= ($current_page == 'prescriptions') ? 'active' : '' ?>">
                <a href="prescriptions" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">clinical_notes</span>
                    <span class="title">Prescriptions</span>
                </a>
            </li>

            <!-- ==========================================
            LABORATORY & PHARMACY (Category Label)
            ========================================== -->
            <li class="menu-category">
                <span class="menu-category-text"> | Laboratory &amp; Pharmacy</span>
            </li>

            <li class="menu-item <?= ($current_page == 'tests') ? 'active' : '' ?>">
                <a href="tests" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">science</span>
                    <span class="title">Tests</span>
                </a>
            </li>

            <li class="menu-item <?= ($current_page == 'medicines') ? 'active' : '' ?>">
                <a href="medicines" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">vaccines</span>
                    <span class="title">Medicines</span>
                </a>
            </li>

            <!-- ==========================================
            BILLING & FINANCE (Category Label)
            ========================================== -->
            <li class="menu-category">
                <span class="menu-category-text"> | Billing &amp; Finance</span>
            </li>

            <li class="menu-item <?= ($current_page == 'billings') ? 'active' : '' ?>">
                <a href="billings" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">receipt_long</span>
                    <span class="title">Billing</span>
                </a>
            </li>

            <li class="menu-item <?= ($current_page == 'create-billing') ? 'active' : '' ?>">
                <a href="create-billing" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">point_of_sale</span>
                    <span class="title">Generate Bill</span>
                </a>
            </li>


<!-- ==========================================
USER MANAGEMENT (Only visible to Admin)
========================================== -->
<?php if (isAdmin()): ?>
    <li class="menu-category">
        <span class="menu-category-text">User Management</span>
    </li>
    <li class="menu-item <?= ($current_page == 'users' || $current_page == 'users/manage') ? 'active' : '' ?>">
        <a href="users" class="menu-link">
            <span class="material-symbols-outlined menu-icon">admin_panel_settings</span>
            <span class="title">Users</span>
        </a>
    </li>
<?php endif; ?>
            
        </ul>
    </aside>
</div>