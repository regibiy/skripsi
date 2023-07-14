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
                    <?php
                    $sql = "SELECT * FROM akun INNER JOIN pasien ON akun.no_kk = pasien.no_kk WHERE pasien.status_hubungan = 'Kepala Keluarga'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $enc_no_kk = encrypt($row['no_kk']);
                        $url = "detail-patient-medical-record.php?noKk=" . urlencode($enc_no_kk);
                        echo "<tr class='row-color'>";
                        echo "<td><a href='" . $url . "' class='text-decoration-none'>" . $row['no_kk'] . "</a>";
                        if ($row['no_indeks'] === NULL || $row['no_indeks'] === "") echo "<td class='indeks'><span class='bg-warning py-1 px-2 rounded'>Pasien Baru. <span class='fw-medium'>Membutuhkan Aksi!</span></span></td>";
                        else echo "<td class='indeks'>" . $row['no_indeks'] . "</td>";
                        echo "<td>" . $row['nama_depan'] . " " . $row['nama_belakang'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "</tr>";
                    };
                    ?>
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
                    <?php
                    $sql = "SELECT * FROM pasien INNER JOIN rekam_medis ON pasien.nik = rekam_medis.nik WHERE no_rekam_medis IS NOT NULL OR status_pasien = 'Luar KK'"; //yang belum punya no rek med dan dalam kk tidak akan ditampilkan
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        if ($row['no_rekam_medis'] === NULL) echo "<td>Tidak dapat ditampilkan</td>";
                        else {
                            $enc_no_rekmed = encrypt($row['no_rekam_medis']);
                            $url = "detail-patient-medical-record.php?noRekmed=" . urlencode($enc_no_rekmed);
                            echo "<td><a href='" . $url . "' class='text-decoration-none'>" . $row['no_rekam_medis'] . "</a></td>";
                        }
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td>" . $row['nama_depan'] . " " . $row['nama_belakang'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_lahir']) . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        if ($row['no_hp'] === NULL || $row['no_hp'] === "") echo "<td>Tidak ada</td>";
                        else echo "<td>" . $row['no_hp'] . "</td>";
                        echo "<td><button class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#" . $row['nik'] . "'>Lihat KTP</button></td>";
                        echo "</tr>";
                    ?>
                        <!-- Modal starts-->
                        <div class="modal fade" id="<?= $row['nik'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7">KTP <?= $row['nama_depan'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <?php
                                        if ($row['ktp'] === NULL || $row['ktp'] === "") echo "<p>" . $row['nama_depan'] . " belum memiliki KTP</p>";
                                        else echo "<img src='../assets/patient_data/" . $row['ktp'] . "' class='img-fluid' width='800' alt='KTP " . $row['nama_depan'] . "' />";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("views/index-footer.php");
