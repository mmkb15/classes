<?php
// BASE_URL_ADMIN define না থাকলে define করো
if (!defined('BASE_URL_ADMIN')) {
    require_once __DIR__ . '/../../config/base.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>assets/css/sidebar-menu.css">
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>assets/css/simplebar.css">
    <link rel="stylesheet" href="<?= BASE_URL_ADMIN ?>assets/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title><?= $pageTitle ?? 'Dashboard' ?> - HMS</title>
    <style>
        .alert-success { background:#d4edda; border:1px solid #c3e6cb; color:#155724; padding:12px 16px; border-radius:8px; margin-bottom:16px; }
        .alert-danger  { background:#f8d7da; border:1px solid #f5c6cb; color:#721c24; padding:12px 16px; border-radius:8px; margin-bottom:16px; }
        .card-stat { border-radius:12px; padding:24px; color:#fff; display:flex; align-items:center; gap:16px; }
        .card-stat i { font-size:36px; opacity:0.8; }
        .card-stat .stat-info h3 { margin:0; font-size:28px; font-weight:700; }
        .card-stat .stat-info p { margin:4px 0 0; opacity:0.9; font-size:14px; }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
        }
    </style>
</head>
<body>
