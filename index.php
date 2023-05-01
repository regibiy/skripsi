<?php
$title = "UPT Puskesmas Alianyang";
include("login.php");
include("view/header.php");
?>

<!-- main starts -->
<div class="d-flex justify-content-center text-center my-pt-main mb-3" id="login">
    <div class="container d-flex flex-wrap justify-content-between align-items-start">
        <?php
        if (check_status_login_pasien()) {
        ?>
            <div class="main bg-white p-2 col-lg-12 col-sm-12 col-md-12">
            <?php
        } else {
            ?>
                <div class="main bg-white p-2 col-lg-9 col-sm-12 col-md-12">
                <?php
            }
                ?>
                <img src="assets/images/icon.png" alt="Puskesmas's Illust" width="500" class="img-fluid" loading="lazy">
                <h1 class="fs-4 text-dark-emphasis">Ujung Tombak Pembangunan Kesehatan</h1>
                <p class="text-secondary mb-0">Selamat datang di web Puskesmas Alianyang! Melalui web ini, Anda dapat mendaftarkan diri dan keluarga Anda untuk mendapatkan akses ke berbagai layanan kesehatan yang tersedia di Puskesmas kami.</p>
                </div>
                <?php
                if (check_status_login_pasien()) {
                ?>
                    <div class="login bg-white rounded shadow-sm border mb-3 d-none">
                    <?php
                } else {
                    ?>
                        <div class="login bg-white rounded shadow-sm border mb-3 col-lg-3 col-sm-12 col-md-12">
                        <?php
                    }
                        ?>
                        <form action="login.php" method="post">
                            <h1 class="fs-4 mb-3 text-dark-emphasis">Masuk</h1>
                            <?php
                            if (isset($_SESSION['error_msg'])) {
                            ?>
                                <p class="fs-6 bg-danger text-white p-1 rounded"><?= $_SESSION['error_msg'] ?></p>
                            <?php
                                unset($_SESSION['error_msg']);
                            }
                            ?>
                            <div class="form-floating mb-3">
                                <?php
                                if (isset($_SESSION['no_berobat']) && !check_status_login_pasien()) {
                                ?>
                                    <input type="number" class="form-control" id="floatingInput" name="no_berobat" value="<?= $_SESSION['no_berobat'] ?>">
                                <?php
                                    unset($_SESSION['no_berobat']);
                                } else {
                                ?>
                                    <input type="number" class="form-control" id="floatingInput" name="no_berobat" placeholder="12345678" autocomplete="off">
                                <?php
                                }
                                ?>
                                <label for="floatingInput">Nomor Berobat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="******">
                                <label for="floatingPassword">Kata Sandi</label>
                                <div class="form-check text-start mt-1">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" onclick="showPassword()">
                                    <label class="form-check-label text-dark-emphasis" for="flexCheckDefault">Lihat Kata Sandi</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" name="login">Masuk</button>
                        </form>
                        <p class="mt-3 mb-0 text-dark-emphasis">Belum memiliki akun? Silahkan <a href="daftar.php" class="text-decoration-none">klik di sini!</a></p>
                        </div>
                    </div>
            </div>
            <!-- main ends -->

            <!-- body starts  -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 150" id="information">
                <path fill="#2cc185" fill-opacity="1" d="M0,64L80,80C160,96,320,128,480,117.3C640,107,800,53,960,42.7C1120,32,1280,64,1360,80L1440,96L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
            </svg>
            <div class="container information">
                <h2 class="fs-4 text-center text-dark-emphasis mb-4">Informasi Kegiatan</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-dark-emphasis">Pemeriksaan Buah Hati</h5>
                                <p class="card-text text-secondary">Ibu pintar, yuk konsultasikan tumbuh kembang dan kesehatan si buah hati anda. Kuota terbatas yaa.</p>
                                <p class="card-text text-secondary">Hari: Senin, 10 April 2023</p>
                                <p class="card-text text-secondary">Jam: 09:00 sampai selesai</p>
                                <p class="card-text text-secondary">Dokter: dr. Rosyadi Akbari M.Sc.Sp.A</p>
                                <a class="text-decoration-none" href="informasi.php">Selengkapnya...</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">05-04-2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-dark-emphasis">Pemeriksaan Buah Hati</h5>
                                <p class="card-text text-secondary">Ibu pintar, yuk konsultasikan tumbuh kembang dan kesehatan si buah hati anda. Kuota terbatas yaa.</p>
                                <p class="card-text text-secondary">Hari: Senin, 10 April 2023</p>
                                <p class="card-text text-secondary">Jam: 09:00 sampai selesai</p>
                                <p class="card-text text-secondary">Dokter: dr. Rosyadi Akbari M.Sc.Sp.A</p>
                                <a class="text-decoration-none" href="informasi.php">Selengkapnya...</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">05-04-2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-dark-emphasis">Pemeriksaan Buah Hati</h5>
                                <p class="card-text text-secondary">Ibu pintar, yuk konsultasikan tumbuh kembang dan kesehatan si buah hati anda. Kuota terbatas yaa.</p>
                                <p class="card-text text-secondary">Hari: Senin, 10 April 2023</p>
                                <p class="card-text text-secondary">Jam: 09:00 sampai selesai</p>
                                <p class="card-text text-secondary">Dokter: dr. Rosyadi Akbari M.Sc.Sp.A</p>
                                <a class="text-decoration-none" href="informasi.php">Selengkapnya...</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">05-04-2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-dark-emphasis">Pemeriksaan Buah Hati</h5>
                                <p class="card-text text-secondary">Ibu pintar, yuk konsultasikan tumbuh kembang dan kesehatan si buah hati anda. Kuota terbatas yaa.</p>
                                <p class="card-text text-secondary">Hari: Senin, 10 April 2023</p>
                                <p class="card-text text-secondary">Jam: 09:00 sampai selesai</p>
                                <p class="card-text text-secondary">Dokter: dr. Rosyadi Akbari M.Sc.Sp.A</p>
                                <a class="text-decoration-none" href="informasi.php">Selengkapnya...</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">05-04-2023</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include("view/footer.php");
// $tanggal_lahir = "2001-10-17";
// $tanggal_sekarang = date('Y-m-d');

// $selisih_tanggal = date_diff(date_create($tanggal_lahir), date_create($tanggal_sekarang));
// $umur = $selisih_tanggal->y;
// echo "Umur: " . $umur . " tahun.";
