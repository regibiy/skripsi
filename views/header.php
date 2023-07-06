<!DOCTYPE html>
<html lang="id">
<!-- class yang dimulai dari my-, adalah style css manual -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/responsive.css">

    <!-- aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="assets/js/script.js"></script>
    <script defer src="assets/js/common.js"></script>
</head>

<body>
    <div class="my-order fixed-top">
        <nav class="navbar navbar-expand-md top-infos bg-dark" data-bs-theme="dark">
            <div class="container-fluid d-flex justify-content-center flex-wrap top-info">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentTop">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContentTop">
                    <div class="navbar-nav">
                        <div class="d-inline-flex align-items-center">
                            <span class="material-symbols-sharp me-1">calendar_month</span>
                            <p id="tanggal" class="mb-0 me-3 fw-light">......</p>
                        </div>
                        <div class="d-inline-flex align-items-center">
                            <span class="material-symbols-sharp me-1">schedule</span>
                            <p id="timer" class="mb-0 me-3 fw-light">......</p>
                        </div>
                        <div class="d-inline-flex align-items-center">
                            <span class="material-symbols-sharp me-1">mail</span>
                            <p class="mb-0 fw-light">alianyang.pnkkota@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-md header">
            <div class="container">
                <div>
                    <a class="navbar-brand text-white fs-6" href="index.php"><img src="assets/images/logo-upt.png" alt="Puskesmas's logo" width="40"> Puskesmas Alianyang</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white fs-6" href="index.php#information">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-6" href="poly-rooms.php">Pendaftaran</a>
                        </li>
                        <?php
                        if (check_status_login_pasien()) {
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white fs-6" href="#" role="button" data-bs-toggle="dropdown">
                                    <?php
                                    if (isset($_SESSION['nama_pasien'])) echo "Hai, " . $_SESSION['nama_pasien'];
                                    ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-dark-emphasis my-dropdown-menu fs-7" href="family-members.php">Data Keluarga</a></li>
                                    <li><a class="dropdown-item text-dark-emphasis my-dropdown-menu fs-7" href="my-registration.php">Pendaftaran Saya</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-dark-emphasis my-dropdown-menu-logout fs-7" href="logout.php">Keluar</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>