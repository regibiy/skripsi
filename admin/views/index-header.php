<!DOCTYPE html>
<html lang="id">

<!-- https://github.com/mustafaerden/responsive-bootstrap5-admin-dashboard -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="assets/style/variables.css" />
    <link rel="stylesheet" href="assets/style/styles.css" />
    <link rel="stylesheet" href="assets/style/responsive.css" />
    <title><?= $title ?></title>
</head>

<body>
    <div class="d-flex main-bg" id="wrapper">
        <!-- Sidebar starts-->
        <div class="bg-blue position-fixed z-3" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fw-bold fs-6"><img src="../assets/images/logo-upt.png" class="img-logo me-2" alt="logo puskesmas">Puskesmas Alianyang</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">local_activity</span>Kegiatan</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">medication</span>Poli</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">supervisor_account</span>Petugas</a>
                <a href="logout.php" class="list-group-item my-list-group-item-action-out bg-transparent second-text"><span class="material-symbols-sharp me-2">power_settings_new</span>Logout</a>
            </div>
        </div>
        <!-- #sidebar-wrapper ends -->

        <!-- Page Content starts, RESPONSIVE UNDER 320 DOESNT WORK-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 fixed-top my-margin-left z-1">
                <div class="d-flex justify-content-start align-items-center">
                    <span class="material-symbols-sharp fs-4 me-2" id="menu-toggle">menu</span>
                    <input type="text" class="form-control text-uppercase search" placeholder="Cari">
                </div>
                <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <img src="images/profile-1.jpg" alt="" width="35" class="rounded">
                </div>
            </nav>