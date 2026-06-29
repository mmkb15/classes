<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="?page=dashboard" class="d-block text-decoration-none position-relative">
            <img src="assets/images/logo-icon.png" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">City Hospital</span>
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">

            <!-- Dashboard (no dropdown) -->
            <li class="menu-item">
                <a href="?page=dashboard" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <!-- Patient Management -->
            <li class="menu-item open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="title">Patient Management</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="patients" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">group</span>
                            <span class="title">Patients</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="admissions" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">bed</span>
                            <span class="title">Admissions</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="history-search" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">history</span>
                            <span class="title">Patient History</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Clinical Management -->
            <li class="menu-item open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="title">Clinical Management</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="doctors" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">medical_services</span>
                            <span class="title">Doctors</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="appointments" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">calendar_month</span>
                            <span class="title">Appointments</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="prescriptions" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">clinical_notes</span>
                            <span class="title">Prescriptions</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Laboratory & Pharmacy -->
            <li class="menu-item open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="title">Laboratory &amp; Pharmacy</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="tests" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">science</span>
                            <span class="title">Tests</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="medicines" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">vaccines</span>
                            <span class="title">Medicines</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Billing & Finance -->
            <li class="menu-item open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="title">Billing &amp; Finance</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="billings" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">receipt_long</span>
                            <span class="title">Billing</span>
                        </a>
                    </li>
                </ul>
            </li>

            
            <!-- User Management (Future) -->
            <!-- <li class="menu-item">
                <a href="User" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">admin_panel_settings</span>
                    <span class="title">User Management</span>
                </a>
            </li> -->



        </ul>
    </aside>
</div>


