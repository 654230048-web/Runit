<?php
require_once __DIR__ . '/functions.php';
$pageTitle = $pageTitle ?? 'IT RUNNER — ปฏิทินและลงทะเบียนงานวิ่ง IT';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('index.php') ?>">
            <i class="fas fa-running text-yellow me-2"></i>IT <span class="text-white">RUNNER</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('index.php') ?>"><i class="fas fa-calendar-alt me-1 text-yellow"></i> ปฏิทินงานวิ่ง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('index.php?province=นครปฐม') ?>"><i class="fas fa-map-marker-alt me-1 text-yellow"></i> งานวิ่งนครปฐม</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-yellow btn-sm px-3 mt-1 mt-lg-0" href="<?= base_url('admin/dashboard.php') ?>"><i class="fas fa-user-shield me-1"></i> ระบบผู้ดูแล</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
