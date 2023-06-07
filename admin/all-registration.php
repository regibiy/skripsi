<?php
$title = "Dasbor Pendaftaran";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "daftar") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Daftar Pendaftaran</p>
        <div class="d-flex flex-column fs-7 col-lg-5 col-12 border mb-2 p-2 gap-2 rounded">
            <div class="d-flex gap-3">
                <input type="date" class="form-control form-control-sm">
                <p class="mb-0">Sampai Dengan</p>
                <input type="date" class="form-control form-control-sm">
                <button class="btn btn-sm btn-primary">Terapkan</button>
            </div>
        </div>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>Nomor Antrian</td>
                        <td>Tanggal Daftar</td>
                        <td>Data Pasien</td>
                        <td>Ruang Poli</td>
                        <td>Tanggal Berobat</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-semibold">O0001</td>
                        <td>03-06-2023</td>
                        <td>
                            <p class="mb-0"> <a href="detail-patient-registration.php" class="text-decoration-none">00923456</a> | Fachri Andika | 27 Tahun</p>
                            <p class="mb-0">6281356300160</p>
                            <p class="mb-0"> Jalan Pangeran Nata Kusuma No. 76</p>
                        </td>
                        <td>Ruang Pemeriksaan Umum</td>
                        <td>06-06-2023</td>
                        <td><span class="status p-1 rounded">Selesai</span></td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">O0002</td>
                        <td>04-06-2023</td>
                        <td>
                            <p class="mb-0"> <a href="detail-patient-registration.php" class="text-decoration-none">10923456</a> | Dewi Sari | 25 Tahun</p>
                            <p class="mb-0">6281433002103</p>
                            <p class="mb-0"> Jalan Pangeran Nata Kusuma No. 76</p>
                        </td>
                        <td>Ruang Kesehatan Gigi dan Mulut</td>
                        <td>06-06-2023</td>
                        <td><span class="status p-1 rounded">Sukses</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include("views/index-footer.php");
