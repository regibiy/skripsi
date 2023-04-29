<!DOCTYPE html>
<html lang="id">
<!-- class yang dimulai dari my-, adalah style css manual -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPT Puskesmas Alianyang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="responsive.css">
</head>

<body>
    <!-- header starts -->
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
                            <p id="tanggal" class="mb-0 me-3 fw-light"></p>
                        </div>
                        <div class="d-inline-flex align-items-center">
                            <span class="material-symbols-sharp me-1">schedule</span>
                            <p id="timer" class="mb-0 me-3 fw-light"></p>
                        </div>
                        <div class="d-inline-flex align-items-center">
                            <span class="material-symbols-sharp me-1">mail</span>
                            <p class="mb-0 fw-light">alianyang.pnkkota@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-md header" data-bs-theme="dark">
            <div class="container">
                <div>
                    <img src="assets/images/logo-upt.png" alt="Puskesmas's logo" width="42">
                    <a class="navbar-brand text-white" href="#">Puskesmas Alianyang</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#informasi">Informasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- header ends -->

    <!-- main starts -->
    <div class="d-flex justify-content-center text-center mb-4 my-mt">
        <div class="container d-flex flex-wrap justify-content-between align-items-start border-bottom">
            <div class="main bg-white p-2">
                <img src="assets/images/icon.png" alt="Puskesmas's Illust" width="500" class="img-fluid" loading="lazy">
                <h1 class="fs-4 text-dark-emphasis">Ujung Tombak Pembangunan Kesehatan</h1>
                <p class="text-secondary mb-0">Selamat datang di web Puskesmas Alianyang! Melalui web ini, Anda dapat mendaftarkan diri dan keluarga Anda untuk mendapatkan akses ke berbagai layanan kesehatan yang tersedia di Puskesmas kami.</p>
            </div>
            <div class="login bg-white my-4 rounded shadow">
                <h1 class="fs-4 mb-3 text-dark-emphasis">Masuk</h1>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="12345678" autocomplete="off">
                    <label for="floatingInput">Nomor Berobat</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="******">
                    <label for="floatingPassword">Kata Sandi</label>
                    <div class="form-check text-start mt-1">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-dark-emphasis" for="flexCheckDefault">Lihat Kata Sandi</label>
                    </div>
                </div>
                <button class="btn btn-success">Masuk</button>
                <p class="mt-3 mb-0 text-dark-emphasis">Belum memiliki akun? Silahkan <a href="#" class="text-decoration-none">klik di sini!</a></p>
            </div>
        </div>
    </div>
    <!-- main ends -->

    <!-- body starts  -->
    <span id="informasi"></span>
    <div class="container">
        <h2 class="fs-4 text-center text-dark-emphasis mb-4">Informasi Kegiatan</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container my-4">
        <h2 class="fs-4 mb-4 text-center text-dark-emphasis">Informasi Kegiatan</h2>
        <div class="informs d-flex flex-column align-items-center">
            <div class="inform d-flex flex-wrap justify-content-evenly align-items-center mb-3">
                <div class="inform-img">
                    <img src="assets/images/1.jpg" alt="information image" class="img-fluid rounded" />
                </div>
                <div class="inform-body">
                    <h2 class="mb-2 mt-3 fs-4 text-dark-emphasis">Praktik Dokter Spesialis Anak</h2>
                    <p class="text-secondary">Ibu pintar, yuk konsultasikan tumbuh kembang dan kesehatan si buah hati anda. Kuota terbatas yaa.</p>
                    <p class="text-secondary">Hari : Senin, 10 April 2023</p>
                    <p class="text-secondary">Jam : 9AM sampai selesai</p>
                    <p class="text-secondary">Dokter : dr. Rosyadi Akbari M.Sc.Sp.A</p>
                </div>
            </div>
            <div class="inform d-flex flex-wrap justify-content-evenly align-items-center mb-3">
                <div class="inform-img">
                    <img src="assets/images/1.jpg" alt="information image" class="img-fluid rounded" />
                </div>
                <div class="inform-body">
                    <h2 class="mb-2 mt-3 fs-4 text-dark-emphasis">Praktik Dokter Spesialis Anak</h2>
                    <p class="text-secondary">Ibu pintar, yuk konsultasikan tumbuh kembang dan kesehatan si buah hati anda. Kuota terbatas yaa.</p>
                    <p class="text-secondary">Hari : Senin, 10 April 2023</p>
                    <p class="text-secondary">Jam : 9AM sampai selesai</p>
                    <p class="text-secondary">Dokter : dr. Rosyadi Akbari M.Sc.Sp.A</p>
                </div>
            </div>
            <div class="inform d-flex flex-wrap justify-content-evenly align-items-center mb-3">
                <div class="inform-img text-end">
                    <img src="assets/images/1.jpg" alt="information image" class="img-fluid rounded" />
                </div>
                <div class="inform-body">
                    <h2 class="mb-2 mt-3 fs-4 text-dark-emphasis">Praktik Dokter Spesialis Anak</h2>
                    <p class="text-secondary">Ibu pintar, yuk konsultasikan tumbuh kembang dan kesehatan si buah hati anda. Kuota terbatas yaa.</p>
                    <p class="text-secondary">Hari : Senin, 10 April 2023</p>
                    <p class="text-secondary">Jam : 9AM sampai selesai</p>
                    <p class="text-secondary">Dokter : dr. Rosyadi Akbari M.Sc.Sp.A</p>
                </div>
            </div>
        </div>
        <p class="mb-0 text-center"><a href="#" class="text-decoration-none">Selengkapnya. . .</a></p>
    </div> -->
    <!-- body ends -->

    <!-- footer starts -->
    <footer class="bg-dark py-5">
        <div class="container d-flex flex-wrap justify-content-md-between justify-content-sm-start align-items-start text-white">
            <div>
                <img src="assets/images/logo-upt.png" alt="puskesmas's logo" class="img-fluid">
                <img src="assets/images/logo.png" alt="goverment's logo" class="img-fluid">
                <p class="mb-0">UPT Puskesmas Alianyang</p>
                <p class="mb-0">Jl. Pangeran Nata Kusuma <br> Kota Pontianak, Kalimantan Barat, 78113</p>
                <p class="mb-0">Telp. 0561-8212307</p>
                <p>email : alianyang.pnkkota@gmail.com</p>
            </div>
            <div>
                <p class="mb-0">Media Sosial Puskesmas</p>
                <p class="mb-0"><i class="fa-brands fa-facebook"></i> Puskesmas Alianyang</p>
                <p><i class="fa-brands fa-instagram"></i> puskesmas_alianyangptk</p>
                <p class="mb-0">Link Navigasi</p>
                <a href="#" class="text-decoration-none text-white d-block">Beranda</a>
                <a href="#daftar" class="text-decoration-none text-white d-block">Pendaftaran</a>
                <a href="#informasi" class="text-decoration-none text-white">Informasi</a>
            </div>
        </div>
    </footer>

    <!-- footer ends -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>















<?php
// $tanggal_lahir = "2001-10-17";
// $tanggal_sekarang = date('Y-m-d');

// $selisih_tanggal = date_diff(date_create($tanggal_lahir), date_create($tanggal_sekarang));
// $umur = $selisih_tanggal->y;
// echo "Umur: " . $umur . " tahun.";
