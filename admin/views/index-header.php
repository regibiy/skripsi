<!DOCTYPE html>
<html lang="id">

<!-- https://github.com/mustafaerden/responsive-bootstrap5-admin-dashboard -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="assets/style/styles.css" />
    <link rel="stylesheet" href="assets/style/responsive.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="assets/js/dashboard.js"></script>
</head>

<body>
    <div class="d-flex main-bg" id="wrapper">
        <!-- Sidebar starts-->
        <div class="bg-blue position-fixed z-3" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fw-bold fs-6"><img src="../assets/images/logo-upt.png" class="img-logo me-2" alt="logo puskesmas">Puskesmas Alianyang</div>
            <div class="list-group list-group-flush my-3">
                <?php
                $currentPath = $_SERVER['PHP_SELF'];
                if ($_SESSION['role'] == "daftar") {
                    if ($currentPath == "/skripsi/admin/index-registration.php" || $currentPath == "/skripsi/admin/index-registration-rancang.php") {
                        echo '
                            <a href="index-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien</a>
                            <a href="activity-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">local_activity</span>Kegiatan</a>
                            <a href="report-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                        ';
                    } elseif ($currentPath == "/skripsi/admin/all-registration.php") {
                        echo '
                            <a href="index-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien</a>
                            <a href="activity-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">local_activity</span>Kegiatan</a>
                            <a href="report-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                        ';
                    } elseif ($currentPath == "/skripsi/admin/patient-registration.php" || $currentPath == "/skripsi/admin/detail-patient-registration.php") {
                        echo '
                            <a href="index-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">patient_list</span>Pasien</a>
                            <a href="activity-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">local_activity</span>Kegiatan</a>
                            <a href="report-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                        ';
                    } elseif ($currentPath == "/skripsi/admin/activity-registration.php" || $currentPath == "/skripsi/admin/add-activity-registration.php" || $currentPath == "/skripsi/admin/edit-activity-registration.php") {
                        echo '
                            <a href="index-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien</a>
                            <a href="activity-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">local_activity</span>Kegiatan</a>
                            <a href="report-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                        ';
                    } elseif ($currentPath == "/skripsi/admin/report-registration.php") {
                        echo '
                            <a href="index-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien</a>
                            <a href="activity-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">local_activity</span>Kegiatan</a>
                            <a href="report-registration.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                        ';
                    }
                } elseif ($_SESSION['role'] == "rekmed") {
                    if ($currentPath == "/skripsi/admin/index-medical-record.php") {
                        echo '
                            <a href="index-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien <span class="ms-2 bg-danger px-2 rounded text-white">2</span></a>
                            <a href="report-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                            ';
                    } elseif ($currentPath == "/skripsi/admin/all-registration-medical-record.php") {
                        echo '
                            <a href="index-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien <span class="ms-2 bg-danger px-2 rounded text-white">2</span></a>
                            <a href="report-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                            ';
                    } elseif ($currentPath == "/skripsi/admin/patient-medical-record.php" || $currentPath == "/skripsi/admin/detail-patient-medical-record.php" || $currentPath == "/skripsi/admin/edit-patient-medical-record.php") {
                        echo '
                            <a href="index-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">patient_list</span>Pasien <span class="ms-2 bg-danger px-2 rounded text-white">2</span></a>
                            <a href="report-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                        ';
                    } elseif ($currentPath == "/skripsi/admin/report-medical-record.php") {
                        echo '
                            <a href="index-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="all-registration-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">browse_activity</span>Pendaftaran</a>
                            <a href="patient-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien <span class="ms-2 bg-danger px-2 rounded text-white">2</span></a>
                            <a href="report-medical-record.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                        ';
                    }
                } elseif ($_SESSION['role'] == "kapus") {
                    if ($currentPath == "/skripsi/admin/index-head.php") {
                        echo '
                            <a href="index-head.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                            <a href="officer.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">admin_panel_settings</span>Petugas</a>
                            <a href="poly-room-head.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">home_health</span>Ruang Poli</a>
                            ';
                    } elseif ($currentPath == "/skripsi/admin/officer.php" || $currentPath == "/skripsi/admin/add-officer.php" || $currentPath == "/skripsi/admin/edit-officer.php") {
                        echo '
                        <a href="index-head.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                        <a href="officer.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">admin_panel_settings</span>Petugas</a>
                        <a href="poly-room-head.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">home_health</span>Ruang Poli</a>
                        ';
                    } elseif ($currentPath == "/skripsi/admin/poly-room-head.php" || $currentPath == "/skripsi/admin/add-poly-room-head.php" || $currentPath == "/skripsi/admin/edit-poly-room-head.php") {
                        echo '
                        <a href="index-head.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                        <a href="officer.php" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">admin_panel_settings</span>Petugas</a>
                        <a href="poly-room-head.php" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">home_health</span>Ruang Poli</a>
                        ';
                    }
                }
                ?>
                <a href="logout.php" class="list-group-item my-list-group-item-action-out bg-transparent second-text"><span class="material-symbols-sharp me-2">power_settings_new</span>Logout</a>
            </div>
        </div>
        <!-- #sidebar-wrapper ends -->

        <!-- Page Content starts -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 fixed-top my-margin-left z-1">
                <div class="d-flex justify-content-start align-items-center">
                    <span class="material-symbols-sharp fs-4 me-2" id="menu-toggle">menu</span>
                </div>
                <div class="navbar-nav ms-auto">
                    <div class="text-dark-emphasis text-end">
                        <p class="mb-0">Hai, <span class="fw-medium"><?= $_SESSION['name'] ?></span></p>
                        <?php
                        if ($_SESSION['role'] == "daftar") {
                            $role = "Pendaftaran";
                        } elseif ($_SESSION['role'] == "rekmed") {
                            $role = "Rekam Medis";
                        } elseif ($_SESSION['role'] == "kapus") {
                            $role = "Kepala Puskesmas";
                        }
                        ?>
                        <p class="mb-0 fs-7">Petugas <?= $role ?></p>
                    </div>
                </div>
            </nav>