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
        // PATIENT HISTORY
        // =============================================
        elseif($page == 'patients/history' || $page == 'patient-history'){
            include_once 'views/pages/patients/history.php';
        }
        
        elseif($page == 'patients/history-search' || $page == 'history-search'){
            include_once 'views/pages/patients/history-search.php';
        }

    // =============================================
    // Admissions MODULE
    // =============================================
    elseif($page == 'admissions/manage' || $page == 'admissions'){
        include_once 'views/pages/admissions/manage.php';
    }
    elseif($page == 'admissions/create' || $page == 'create-admission'){
        include_once 'views/pages/admissions/create.php';
    }
    elseif($page == 'admissions/discharge' || $page == 'discharge-admission'){
        include_once 'views/pages/admissions/discharge.php';
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
    elseif($page == 'doctors/view'){
        include_once 'views/pages/doctors/view.php';
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
    // MEDICINES MODULE
    // =============================================
    elseif($page == 'medicines/manage' || $page == 'medicines'){
        include_once 'views/pages/medicines/manage.php';
    }
    elseif($page == 'medicines/create' || $page == 'create-medicine'){
        include_once 'views/pages/medicines/create.php';
    }
    elseif($page == 'medicines/edit' || $page == 'edit-medicine'){
        include_once 'views/pages/medicines/edit.php';
    }


    // =============================================
    // TESTS MODULE
    // =============================================
    elseif($page == 'tests/manage' || $page == 'tests'){
        include_once 'views/pages/tests/manage.php';
    }
    elseif($page == 'tests/create' || $page == 'create-test'){
        include_once 'views/pages/tests/create.php';
    }
    elseif($page == 'tests/edit' || $page == 'edit-test'){
        include_once 'views/pages/tests/edit.php';
    }

    // =============================================
    // BILLING MODULE
    // =============================================
    elseif($page == 'billings/manage' || $page == 'billings'){
        include_once 'views/pages/billings/manage.php';
    }
    elseif($page == 'billings/create' || $page == 'create-billing'){
        include_once 'views/pages/billings/create.php';
    }
    elseif($page == 'billings/edit' || $page == 'edit-billing'){
        include_once 'views/pages/billings/edit.php';
    }    
        // =============================================
        // BILLING - VIEW & PRINT
        // =============================================
        elseif($page == 'billings/view' || $page == 'view-billings'){
            include_once 'views/pages/billings/view.php';
        }
        elseif($page == 'billings/print' || $page == 'print-billings'){
            include_once 'views/pages/billings/print.php';
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