<?php
$title = "Dasbor Rekam Medis";
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
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Daftar Kepala Keluarga</p>
        <div class="table-responsive border rounded p-2 fs-7 mb-2">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>Nomor KK</td>
                        <td>Nomor Indeks </td>
                        <td>Nama Kepala Keluarga</td>
                        <td>Email</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="detail-patient-medical-record.php" class="text-decoration-none">7383091434760008</a>
                        </td>
                        <td>954987</td>
                        <td>Fachri Andika Permana</td>
                        <td>fachriandika@gmail.com</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="detail-patient-medical-record.php" class="text-decoration-none">7383079887430008</a>
                        </td>
                        <td>912650</td>
                        <td>Bima Putra Mahendra</td>
                        <td>bimaputra@gmail.com</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="fs-6 p-0 mb-2 fw-medium">Daftar Pasien Umum</p>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="patient-medical-record" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>No. Rekmed</td>
                        <td>NIK</td>
                        <td>Nama</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>No. HP</td>
                        <td>KTP</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="detail-patient-medical-record.php" class="text-decoration-none">00945678</a>
                        </td>
                        <td>2151331605010002</td>
                        <td>Fachri Andika Permana</td>
                        <td>16-10-2001</td>
                        <td>Laki-Laki</td>
                        <td>6281378300210</td>
                        <td><button class="btn btn-sm btn-outline-primary">Lihat KTP</button></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="detail-patient-medical-record.php" class="text-decoration-none">10945678</a>
                        </td>
                        <td>2151051910010007</td>
                        <td>Dewi Sari Pramudita</td>
                        <td>24-12-2004</td>
                        <td>Perempuan</td>
                        <td>6281433002103</td>
                        <td><button class="btn btn-sm btn-outline-primary">Lihat KTP</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include("views/index-footer.php");
