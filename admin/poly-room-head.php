<?php
$title = "Dasbor Kepala Puskesmas";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "kapus") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}
include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-4 mb-5 p-2 bg-white rounded text-dark-emphasis">
        <div class="px-0 pb-2 fs-7 col-lg-3 col-sm-12 col-md-6">
            <p class="fs-6 p-0 mb-2 fw-medium">Kuota Pendaftaran</p>
            <?php
            include("manage-kuota.php");
            ?>
        </div>
        <div class="d-flex justify-content-between px-0 pb-2 mt-3">
            <p class="fs-6 p-0 mb-2 fw-medium">Daftar Ruang Poli</p>
            <a href="add-poly-room-head.php" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="table-responsive border rounded p-2 fs-7">
            <?php
            include("poly-room-list.php");
            ?>
        </div>
    </div>
</div>

<?php
include("views/index-footer.php");
