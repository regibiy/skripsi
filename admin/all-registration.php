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

if (isset($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir'])) {
    $enc_tanggal_awal = $_GET['tanggalAwal'];
    $enc_tanggal_akhir = $_GET['tanggalAkhir'];
    $dec_tanggal_awal = decrypt($enc_tanggal_awal);
    $dec_tanggal_akhir = decrypt($enc_tanggal_akhir);
    $sql = "SELECT * FROM pendaftaran INNER JOIN rekam_medis ON pendaftaran.no_rekam_medis = rekam_medis.no_rekam_medis
    INNER JOIN pasien ON rekam_medis.nik = pasien.nik INNER JOIN akun ON pasien.no_kk = akun.no_kk
    INNER JOIN ruang_poli ON pendaftaran.id_ruang_poli = ruang_poli.id_ruang_poli
    WHERE tanggal_berobat BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir'";
} else {
    $tanggal = date('Y-m-d');
    $sql = "SELECT * FROM pendaftaran INNER JOIN rekam_medis ON pendaftaran.no_rekam_medis = rekam_medis.no_rekam_medis
    INNER JOIN pasien ON rekam_medis.nik = pasien.nik INNER JOIN akun ON pasien.no_kk = akun.no_kk
    INNER JOIN ruang_poli ON pendaftaran.id_ruang_poli = ruang_poli.id_ruang_poli
    WHERE tanggal_berobat = '$tanggal'";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Daftar Pendaftaran</p>
        <p id="alert" class="bg-danger fs-7 text-white rounded px-2 py-1" style="display: none;"></p>
        <div class="d-flex flex-column fs-7 col-lg-5 col-12 border mb-2 p-2 gap-2 rounded">
            <form action="action-admin.php" method="post" onsubmit="return validasiSetTanggal()">
                <div class="d-flex gap-3">
                    <?php
                    if (isset($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir'])) echo "<input type='date' class='form-control form-control-sm' id='tanggalAwal' name='tanggal_awal' value='" . $dec_tanggal_awal . "' required>";
                    else echo "<input type='date' class='form-control form-control-sm' id='tanggalAwal' name='tanggal_awal' required>";
                    ?>
                    <p class="mb-0">Sampai Dengan</p>
                    <?php
                    if (isset($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir'])) echo "<input type='date' class='form-control form-control-sm' id='tanggalAkhir' name='tanggal_akhir' value='" . $dec_tanggal_akhir . "' required>";
                    else echo "<input type='date' class='form-control form-control-sm' id='tanggalAkhir' name='tanggal_akhir' required>";
                    ?>
                    <button type="submit" class="btn btn-sm btn-primary" name="set_tanggal_daftar">Terapkan</button>
                </div>
            </form>
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
                    <?php
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='fw-semibold'>" . $row['nomor_antrian'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_daftar']) . "</td>";
                        echo "<td>";
                        $tanggal_lahir = $row['tanggal_lahir'];
                        $tanggal_berobat = $row['tanggal_berobat'];
                        $selisih = date_diff(date_create($tanggal_lahir), date_create($tanggal_berobat));
                        $umur = $selisih->y;
                        $enc_no_rekam_medis = encrypt($row['no_rekam_medis']);
                        $url = "detail-patient-registration.php?noRekmed=" . urlencode($enc_no_rekam_medis);
                        echo "<p class='mb-0'> <a href='" . $url . "' class='text-decoration-none'>" . $row['no_rekam_medis'] . "</a> | " . $row['nama_depan'] . " " . $row['nama_belakang'] . " | " . $umur . " Tahun</p>";
                        echo "<p class='mb-0'>" . $row['no_hp'] . "</p>";
                        echo "<p class='mb-0'>" . $row['alamat'] . "</p>";
                        echo "</td>";
                        echo "<td>" . $row['nama_ruang_poli'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_berobat']) . "</td>";
                        echo "<td><span class='status py-1 px-2 rounded'>" . $row['status_pendaftaran'] . "</span></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("views/index-footer.php");
