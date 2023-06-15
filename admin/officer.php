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
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <div class="d-flex justify-content-between px-0 pb-2">
            <p class="fs-6 p-0 mb-2 fw-medium">Daftar Petugas Puskesmas</p>
            <a href="add-officer.php" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <?php
        include("officer-list.php");
        ?>
    </div>
</div>

<?php
include("views/index-footer.php");
