<?php
$title = "Dasbor Pendaftaran";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "rekmed") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <form action="action-admin.php" method="post" onsubmit="return validasiSetTanggal()">
        <div class="row mt-3 mb-5 p-2 bg-white rounded">
            <div class="px-0 pb-2 text-dark-emphasis">
                <p class="fs-6 p-0 mb-2 fw-medium">Laporan Kontak Tak Langsung</p>
                <p id="alert" class="bg-danger fs-7 px-2 py-1 rounded text-white" style="display: none;"></p>
                <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 gap-2 rounded">
                    <label for="periode" class="form-label form-label-sm mb-0">Periode Laporan</label>
                    <div class="d-flex gap-3">
                        <input type="date" class="form-control form-control-sm" id="tanggalAwal" name="tanggal_awal" required>
                        <p class="mb-0">Sampai Dengan</p>
                        <input type="date" class="form-control form-control-sm" id="tanggalAkhir" name="tanggal_akhir" required>
                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <button type="submit" class="btn btn-sm btn-primary" name="cetak_laporan_rekmed">Cetak Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include("views/index-footer.php");
