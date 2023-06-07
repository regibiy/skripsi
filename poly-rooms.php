<?php
$title = "Ruang Poli";
include("action.php");
if (!check_status_login_pasien()) {
    $_SESSION['error_msg'] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}
include("views/header.php");
?>

<div class="text-center my-mtb-body">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <div class="p-2 col-lg-12 col-sm-12 col-md-12 text-dark-emphasis">
            <h1 class="greeting fs-4">......</h1>
            <p>Informasi ruang poli dan pendaftaran di UPT Puskesmas Alianyang</p>
            <p class="fs-7">Kuota Tersedia: <span class="fw-medium">9999</span> dari <span class="fw-medium">9999</span></p>
            <div class="row g-3 align-items-center justify-content-center fs-7">
                <div class="col-auto">
                    <label for="register_date" class="col-form-label col-form-label-sm">Tanggal</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="register_date" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success btn-sm">Terapkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container d-flex justify-content-center flex-wrap gap-4">
    <div class="card my-animation-poly" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">x-30-x</h5>
            <img src="assets/images/general_poly.jpg" class="card-img-top img-fluid" alt="general poly">
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : 9999</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : 9999</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : 9999</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">x-30-x</h5>
            <img src="assets/images/general_poly.jpg" class="card-img-top img-fluid" alt="general poly">
            <!-- <img src="assets/images/dentist.jpg" class="card-img-top img-fluid" alt="dentist"> -->
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : 9999</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : 9999</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : 9999</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">x-30-x</h5>
            <img src="assets/images/general_poly.jpg" class="card-img-top img-fluid" alt="general poly">
            <!-- <img src="assets/images/common_action.jpg" class="card-img-top img-fluid" alt="common actions"> -->
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : 9999</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : 9999</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : 9999</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">x-30-x</h5>
            <img src="assets/images/general_poly.jpg" class="card-img-top img-fluid" alt="general poly">
            <!-- <img src="assets/images/physio.jpg" class="card-img-top img-fluid" alt="physiotherapy"> -->
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : 9999</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : 9999</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : 9999</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">Ruang Kesehatan Lingkungan</h5>
            <img src="assets/images/sanitation.jpg" class="card-img-top img-fluid" alt="sanitation">
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : xxx</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : xxx</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : xxx</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">Ruang Infeksi Menular Seksual</h5>
            <img src="assets/images/ims.jpg" class="card-img-top img-fluid" alt="ims">
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : xxx</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : xxx</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : xxx</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">Ruang Imunisasi</h5>
            <img src="assets/images/imun.jpg" class="card-img-top img-fluid" alt="ims">
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : xxx</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : xxx</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : xxx</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">Ruang KIA/KB</h5>
            <img src="assets/images/kia.jpg" class="card-img-top img-fluid" alt="ims">
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : xxx</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : xxx</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : xxx</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">Ruang Laktasi</h5>
            <img src="assets/images/laktasi.jpg" class="card-img-top img-fluid" alt="ims">
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : xxx</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : xxx</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : xxx</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-dark-emphasis fs-6">Ruang Gizi</h5>
            <img src="assets/images/gizi.jpg" class="card-img-top img-fluid" alt="ims">
            <p class="card-text text-secondary fs-7 mb-0">Jumlah antrian : xxx</p>
            <p class="card-text text-secondary fs-7 mb-0">Antrian yang telah dilayani : xxx</p>
            <p class="card-text text-secondary fs-7">Sisa antrian : xxx</p>
            <a href="registration.php" class="btn btn-sm btn-success">Daftar</a>
        </div>
    </div>
</div>

<?php
include("views/footer.php");
