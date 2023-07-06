<?php
$title = "Ruang Poli";
include("action.php");
if (!check_status_login_pasien()) {
    $_SESSION['error_msg'] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
} else {
    if (isset($_GET['treatmentdate'])) {
        $enc_treatment_date = $_GET['treatmentdate'];
        $treatment_date = decrypt($enc_treatment_date);
    } else {
        $treatment_date = date('Y-m-d');
        $get_national_holiday = cek_libur_nasional($treatment_date);
    }
}

if (isset($_GET['nationalholiday'])) $national_holiday = $_GET['nationalholiday'];
if (isset($get_national_holiday)) $national_holiday = $get_national_holiday;

$queue_number = generate_queue_number($treatment_date);

include("views/header.php");

?>
<div class="text-center my-mtb-body">
    <div class="container d-flex flex-wrap justify-content-center align-items-center">
        <div class="col-12 text-dark-emphasis">
            <h1 class="greeting fs-4">......</h1>
            <p>Informasi ruang poli dan pendaftaran di UPT Puskesmas Alianyang</p>
            <?php
            $sql = "SELECT COUNT(id_pendaftaran) as total from pendaftaran WHERE tanggal_berobat = '$treatment_date' AND status_pendaftaran <> 'Dibatalkan'";
            $result = $conn->query($sql);
            $tersedia = $result->fetch_assoc();
            $result = get_data("kuota");
            $total = $result->fetch_assoc();
            $tersedia = $total['kuota_tersedia'] - $tersedia['total'];
            if ($tersedia === 0) echo "<p class='fs-7'><span class='bg-danger rounded px-2 py-1 text-white'>Kuota hari ini telah penuh! Silakan pilih hari lain</span></p>";
            echo "<p class='fs-7 mb-0'>Kuota Tersedia: <span class='fw-medium'>" . $tersedia . "</span> dari <span class='fw-medium'>" . $total['kuota_tersedia'] . "</span></p>";
            ?>
            <form action="action.php" method="post" onsubmit="return validasiTanggalDaftar()">
                <div class="row g-3 align-items-center justify-content-center fs-7 mt-2">
                    <div class="col-auto">
                        <label for="treatmentDate" class="col-form-label col-form-label-sm">Tanggal</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" id="treatmentDate" name="treatment_date" class="form-control form-control-sm" value="<?= $treatment_date ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success btn-sm" name="pilih_tanggal">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_SESSION['error_msg'])) {
            echo "<p class='bg-danger text-white py-1 px-2 rounded mb-0 mt-3 fs-7'>" . $_SESSION['error_msg'] . "</p>";
            unset($_SESSION['error_msg']);
        }
        ?>
        <p id="alert" class="bg-danger text-white py-1 px-2 rounded mb-0 mt-3 fs-7" style="display: none;"></p>
    </div>
</div>
<!-- info minggu starts -->
<div class="container d-flex flex-wrap justify-content-center align-items-center text-dark-emphasis d-none" id="minggu"></div>
<!-- info minggu ends  -->
<div class="container d-flex justify-content-center flex-wrap gap-4" id="listPoly">
    <?php
    // validasi hari libur nasional
    if (isset($national_holiday)) {
    ?>
        <div class="container d-flex flex-wrap justify-content-center align-items-center">
            <div class="col-xl-6 col-12 text-end" data-aos="zoom-in-up">
                <img src="assets/images/close.jpg" alt="" class="img-fluid" width="500">
            </div>
            <div class="col-xl-6 col-12 text-xl-start text-center text-dark-emphasis" data-aos="zoom-in-up">
                <h3 class="fs-4">Maaf...</h3>
                <p class="fs-7 mb-2">Pada tanggal <span class="fw-medium"><?= format_date($treatment_date) ?></span> Puskesmas tidak melayani apapun karena memperingati <span class="fw-medium"><?= $national_holiday ?></span></p>
                <p class="fs-7">Silakan pilih tanggal berobat yang lain</p>
            </div>
        </div>
    <?php
    } else {
        $sql = "SELECT ruang_poli.id_ruang_poli, ruang_poli.nama_ruang_poli, ruang_poli.gambar_ruang_poli, COALESCE(jumlah_pendaftar, 0) AS jumlah_pendaftar, 
                COALESCE(pendaftar_terlayani, 0) AS pendaftar_terlayani FROM ruang_poli 
                LEFT JOIN (SELECT id_ruang_poli, COUNT(id_pendaftaran) AS jumlah_pendaftar FROM pendaftaran 
                WHERE tanggal_berobat = '$treatment_date' AND status_pendaftaran <> 'Dibatalkan' GROUP BY id_ruang_poli) AS pendaftar ON ruang_poli.id_ruang_poli = pendaftar.id_ruang_poli 
                LEFT JOIN (SELECT id_ruang_poli, COUNT(id_pendaftaran) AS pendaftar_terlayani FROM pendaftaran
                WHERE tanggal_berobat = '$treatment_date' AND (status_pendaftaran <> 'Menunggu' AND status_pendaftaran <> 'Dibatalkan') GROUP BY id_ruang_poli)
                AS terlayani ON ruang_poli.id_ruang_poli = terlayani.id_ruang_poli WHERE ruang_poli.status_ruang_poli = 'Aktif'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($tersedia === 0) {
                // validasi menghindari minus
                if ($row['jumlah_pendaftar'] != 0) $sisa_antrian = $row['jumlah_pendaftar'] - $row['pendaftar_terlayani'];
                else $sisa_antrian = $row['jumlah_pendaftar'];
                echo "
            <div class='card my-animation-poly' style='width: 18rem;' data-aos='zoom-in'>
                <div class='card-body'>
                    <h5 class='card-title text-dark-emphasis fs-6'>" . $row['nama_ruang_poli'] . "</h5>
                    <img src='admin/assets/images/" . $row['gambar_ruang_poli'] . "' class='card-img-top img-fluid' alt='" . $row['nama_ruang_poli'] . "'>
                    <p class='card-text text-secondary fs-7 mb-0'>Jumlah antrian : " . $row['jumlah_pendaftar'] . "</p>
                    <p class='card-text text-secondary fs-7 mb-0'>Antrian yang telah dilayani : " . $row['pendaftar_terlayani'] . "</p>
                    <p class='card-text text-secondary fs-7'>Sisa antrian : " . $sisa_antrian . "</p>
                    <button type='button' class='btn btn-sm btn-success' disabled>Daftar</button>
                </div>
            </div>
        ";
            } else {
                $enc_treatment_date = encrypt($treatment_date);
                $enc_queue_number = encrypt($queue_number);
                $enc_ruang_poli = encrypt($row['id_ruang_poli']);
                $url = "registration.php?treatmentdate=" . urlencode($enc_treatment_date) . "&queuenumber=" . urlencode($enc_queue_number) . "&ruangpoli=" . urlencode($enc_ruang_poli);
                // validasi menghindari minus
                if ($row['jumlah_pendaftar'] != 0) $sisa_antrian = $row['jumlah_pendaftar'] - $row['pendaftar_terlayani'];
                else $sisa_antrian = $row['jumlah_pendaftar'];

                echo "<div class='card my-animation-poly' style='width: 18rem;' data-aos='zoom-in'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title text-dark-emphasis fs-6'>" . $row['nama_ruang_poli'] . "</h5>";
                echo "<img src='admin/assets/images/" . $row['gambar_ruang_poli'] . "' class='card-img-top img-fluid' alt='" . $row['nama_ruang_poli'] . "'>";
                echo "<p class='card-text text-secondary fs-7 mb-0'>Jumlah antrian : " . $row['jumlah_pendaftar'] . "</p>";
                echo "<p class='card-text text-secondary fs-7 mb-0'>Antrian yang telah dilayani : " . $row['pendaftar_terlayani'] . "</p>";
                echo "<p class='card-text text-secondary fs-7'>Sisa antrian : " . $sisa_antrian . "</p>";

                $hari = date('Y-m-d');
                $hari_daftar = date('N', strtotime($hari));
                $jam_daftar = (date('H:i'));
                $daftar = strtotime($jam_daftar);
                if ($hari_daftar >= 1 && $hari_daftar <= 4) {
                    $jam_tutup = "11:30";
                    $tutup = strtotime($jam_tutup);
                } else {
                    $jam_tutup = "09:30";
                    $tutup = strtotime($jam_tutup);
                }
                // validasi tanggal
                if (strtotime($treatment_date) === strtotime($hari)) {
                    if ($daftar > $tutup) echo "<button type='button' class='btn btn-sm btn-success' disabled>Daftar</button>";
                    else echo "<a href='" . $url . "' class='btn btn-sm btn-success'>Daftar</a>";
                } else echo "<a href='" . $url . "' class='btn btn-sm btn-success'>Daftar</a>";
                echo "</div>";
                echo "</div>";
            }
        }
    }
    ?>
</div>

<?php
include("views/footer.php");
