# Hospital Management System - Setup Guide

## ধাপ ১: Files Copy করো
এই `hospital` folder টা পুরোটা XAMPP এর `htdocs` folder এ paste করো:
```
C:\xampp\htdocs\hospital\
```

## ধাপ ২: Database Import করো
1. XAMPP এ Apache ও MySQL চালু করো
2. Browser এ যাও: http://localhost/phpmyadmin
3. "New" বাটনে click করে database বানাও: `hospital_db`
4. `hospital_db.sql` file টা Import করো

## ধাপ ৩: Config Check করো
`admin/config/base.php` খুলে দেখো:
```php
define('BASE_URL', 'http://localhost/hospital/');
define('BASE_URL_ADMIN', 'http://localhost/hospital/admin/');
```
Folder নাম ঠিক আছে কিনা দেখো।

## ধাপ ৪: Project চালাও
Browser এ যাও: http://localhost/hospital/

## Login Credentials
- Username: `admin`
- Password: `admin123`

## Project Structure
```
hospital/
├── index.php              ← Login page
├── hospital_db.sql        ← Database file
└── admin/
    ├── index.php          ← Dashboard
    ├── logout.php
    ├── config/
    │   ├── base.php       ← URL config
    │   ├── db.php         ← Database connection
    │   └── auth.php       ← Login check
    └── views/
        ├── layouts/
        │   ├── header.php
        │   ├── sidebar.php
        │   └── footer.php
        └── pages/
            ├── patients/  ← CRUD
            ├── doctors/   ← CRUD
            ├── appointments/ ← Book + Slip Print
            └── reports/   ← Printable Report
```

## Features
✅ Admin Login/Logout
✅ Patient CRUD (Add/List/Edit/Delete)
✅ Doctor CRUD (Add/List/Edit/Delete)
✅ Appointment Booking
✅ Appointment Status Update (Confirm/Cancel)
✅ Appointment Slip Print ← Teacher এর "process" দেখানোর জন্য
✅ Appointment Report (Date Filter + Print)
