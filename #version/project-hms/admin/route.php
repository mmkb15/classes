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
    elseif($page == 'patients/create'){
        include_once 'views/pages/patients/create.php';
    }
    elseif($page == 'patients/edit'){
        include_once 'views/pages/patients/edit.php';
    }
    
    // =============================================
    // DOCTORS MODULE
    // =============================================
    elseif($page == 'doctors/manage' || $page == 'doctors'){
        include_once 'views/pages/doctors/manage.php';
    }
    elseif($page == 'doctors/create'){
        include_once 'views/pages/doctors/create.php';
    }
    elseif($page == 'doctors/edit'){
        include_once 'views/pages/doctors/edit.php';
    }
    
    // =============================================
    // APPOINTMENTS MODULE
    // =============================================
    elseif($page == 'appointments/manage' || $page == 'appointments'){
        include_once 'views/pages/appointments/manage.php';
    }
    elseif($page == 'appointments/create'){
        include_once 'views/pages/appointments/create.php';
    }
    elseif($page == 'appointments/edit'){
        include_once 'views/pages/appointments/edit.php';
    }
    
    // =============================================
    // PRESCRIPTIONS MODULE
    // =============================================
    elseif($page == 'prescriptions/manage' || $page == 'prescriptions'){
        include_once 'views/pages/prescriptions/manage.php';
    }
    elseif($page == 'prescriptions/create'){
        include_once 'views/pages/prescriptions/create.php';
    }
    elseif($page == 'prescriptions/view'){
        include_once 'views/pages/prescriptions/view.php';
    }
    elseif($page == 'prescriptions/print'){
        include_once 'views/pages/prescriptions/print.php';
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