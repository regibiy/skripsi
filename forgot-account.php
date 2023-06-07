<?php
$title = "Lupa Akun";
include("action.php");
include("views/header.php");
?>

<!-- body starts -->
<div class="container d-flex justify-content-center my-mtb-body">
    <div class="d-flex flex-column gap-4 col-lg-5 col-sm-12 col-md-7">
        <label for="email" class="form-label mb-0 fs-6 text-dark-emphasis">Email yang terdaftar</label>
        <input type="email" class="form-control fs-7 text-dark-emphasis" id="email" placeholder="pasien@domain.com">
        <!-- <p class="mb-0 bg-danger text-white fs-7 p-1 rounded">Pesan keberhasilan dan kegagalan</p> -->
        <button class="btn btn-sm btn-success fs-6">Kirim nomor berobat dan kata sandi</button>
    </div>
</div>
<!-- body ends -->

<?php
include("views/footer.php");
