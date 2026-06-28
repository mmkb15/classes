<?php

if(isset($_GET['page'])){
    $page = $_GET['page'];

    // =============================================
    // DASHBOARD
    // =============================================
    if($page == 'dashboard' || $page == 'dashboard.php'){
        include_once 'views/pages/dashboard.php';
    } 
    
    // =============================================
    // PATIENTS MODULE
    // =============================================
    elseif($page == 'patients/manage' || $page == 'patients'){
        include_once 'views/pages/patients/manage.php';
    }
    elseif($page == 'patients/create' || $page == 'create-patient'){
        include_once 'views/pages/patients/create.php';
    }
    elseif($page == 'patients/edit' || $page == 'edit-patient'){
        include_once 'views/pages/patients/edit.php';
    }
    
    // =============================================
    // DOCTORS MODULE
    // =============================================
    elseif($page == 'doctors/manage' || $page == 'doctors'){
        include_once 'views/pages/doctors/manage.php';
    }
    elseif($page == 'doctors/create' || $page == 'create-doctor'){
        include_once 'views/pages/doctors/create.php';
    }
    elseif($page == 'doctors/edit' || $page == 'edit-doctor'){
        include_once 'views/pages/doctors/edit.php';
    }
    
    // =============================================
    // APPOINTMENTS MODULE
    // =============================================
    elseif($page == 'appointments/manage' || $page == 'appointments'){
        include_once 'views/pages/appointments/manage.php';
    }
    elseif($page == 'appointments/create' || $page == 'create-appointment'){
        include_once 'views/pages/appointments/create.php';
    }
    elseif($page == 'appointments/edit' || $page == 'edit-appointment'){
        include_once 'views/pages/appointments/edit.php';
    }
    
    // =============================================
    // PRESCRIPTIONS MODULE
    // =============================================
    elseif($page == 'prescriptions/manage' || $page == 'prescriptions'){
        include_once 'views/pages/prescriptions/manage.php';
    }
    elseif($page == 'prescriptions/create' || $page == 'create-prescription'){
        include_once 'views/pages/prescriptions/create.php';
    }
    elseif($page == 'prescriptions/view' || $page == 'view-prescription'){
        include_once 'views/pages/prescriptions/view.php';
    }
    elseif($page == 'prescriptions/print' || $page == 'print-prescription'){
        include_once 'views/pages/prescriptions/print.php';
    }
    
    // =============================================
    // Admissions MODULE
    // =============================================
    elseif($page == 'admissions/manage' || $page == 'admissions'){
        include_once 'views/pages/admissions/manage.php';
    }
    elseif($page == 'admissions/create'){
        include_once 'views/pages/admissions/create.php';
    }
    elseif($page == 'admissions/discharge'){
        include_once 'views/pages/admissions/discharge.php';
    }

    // =============================================
    // MEDICINES MODULE
    // =============================================
    elseif($page == 'medicines/manage' || $page == 'medicines'){
        include_once 'views/pages/medicines/manage.php';
    }
    elseif($page == 'medicines/create'){
        include_once 'views/pages/medicines/create.php';
    }
    elseif($page == 'medicines/edit'){
        include_once 'views/pages/medicines/edit.php';
    }


    // =============================================
    // TESTS MODULE
    // =============================================
    elseif($page == 'tests/manage' || $page == 'tests'){
        include_once 'views/pages/tests/manage.php';
    }
    elseif($page == 'tests/create'){
        include_once 'views/pages/tests/create.php';
    }
    elseif($page == 'tests/edit'){
        include_once 'views/pages/tests/edit.php';
    }

    // =============================================
    // BILLING MODULE
    // =============================================
    elseif($page == 'billings/manage' || $page == 'billings'){
        include_once 'views/pages/billings/manage.php';
    }
    elseif($page == 'billings/create'){
        include_once 'views/pages/billings/create.php';
    }
    elseif($page == 'billings/edit'){
        include_once 'views/pages/billings/edit.php';
    }    

    // =============================================
    // PATIENT HISTORY
    // =============================================
    elseif($page == 'history'){
        include_once 'views/pages/patients/history.php';
    }


    // =============================================
    // 404 - PAGE NOT FOUND
    // =============================================
    else{
        include_once 'views/pages/dashboard.php';
    }
}
else{
    include_once 'views/pages/dashboard.php';
}

?>