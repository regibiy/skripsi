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
        <p class="fs-6 p-0 mb-2 fw-medium">Daftar Pasien Umum</p>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>No. KK</td>
                        <td>No. Rekmed</td>
                        <td>Nama</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Agama</td>
                        <td>Nomor HP</td>
                        <td>KTP</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="detail-patient-registration.php" class="text-decoration-none">7383091434760008</a>
                        </td>
                        <td>00945678</td>
                        <td>Fachri Andika Permana</td>
                        <td>16-10-2001</td>
                        <td>Laki-Laki</td>
                        <td>Islam</td>
                        <td>6281378300210</td>
                        <td class="text-secondary"><button type="button" class="btn btn-sm btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#ktpSuami">Lihat KTP</button></td>
                        <!-- Modal starts-->
                        <div class="modal fade" id="ktpSuami" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">KTP x-6-x</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center"><img src="assets/patient_data/KTP.jpg" class="img-fluid" width="400" alt="ktp" /></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                    </tr>
                    <tr>
                        <td>
                            <a href="detail-patient-registration.php" class="text-decoration-none">7383091434760008</a>
                        </td>
                        <td>10945678</td>
                        <td>Dewi Sari Pramudita</td>
                        <td>24-12-2002</td>
                        <td>Perempuan</td>
                        <td>Islam</td>
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
