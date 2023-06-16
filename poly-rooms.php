<?php
$title = "Ruang Poli";
include("action.php");
if (!check_status_login_pasien()) {
    $_SESSION['error_msg'] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
    exit;
}

if (isset($_GET['registerdate'])) $register_date = $_GET['registerdate'];
else $register_date = date('Y-m-d');

$queue_number = generate_queue_number($register_date);

include("views/header.php");
?>

<div class="text-center my-mtb-body">
    <div class="container d-flex flex-wrap justify-content-center align-items-center">
        <div class="col-12 text-dark-emphasis">
            <h1 class="greeting fs-4">......</h1>
            <p>Informasi ruang poli dan pendaftaran di UPT Puskesmas Alianyang</p>
            <?php
            $sql = "SELECT COUNT(id_pendaftaran) as total from pendaftaran WHERE tanggal_daftar = '$register_date'";
            $result = $conn->query($sql);
            $tersedia = $result->fetch_assoc();
            $result = get_data("kuota");
            $total = $result->fetch_assoc();
            $tersedia = $total['kuota_tersedia'] - $tersedia['total'];
            if ($tersedia === 0) {
                $_SESSION['error_msg'] = "Kuota hari ini telah penuh! Silakan pilih hari lain";
            }
            echo "<p class='fs-7 mb-0'>Kuota Tersedia: <span class='fw-medium'>" . $tersedia . "</span> dari <span class='fw-medium'>" . $total['kuota_tersedia'] . "</span></p>";

            if (isset($_SESSION['error_msg'])) {
                echo "<p class='fs-7 fw-medium mb-0'>" . $_SESSION['error_msg'] . "</p>";
                unset($_SESSION['error_msg']);
            }
            ?>
            <form action="action.php" method="post" onsubmit="return validasiTanggalDaftar()">
                <div class="row g-3 align-items-center justify-content-center fs-7 mt-2">
                    <div class="col-auto">
                        <label for="registerDate" class="col-form-label col-form-label-sm">Tanggal</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" id="registerDate" name="register_date" class="form-control form-control-sm" value="<?= $register_date ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success btn-sm" name="pilih_tanggal">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>
        <p id="alert" class="bg-danger text-white py-1 px-2 rounded mb-0 mt-3 fs-7" style="display: none;"></p>
    </div>
</div>

<div class="container d-flex justify-content-center flex-wrap gap-4">
    <?php
    $sql = "SELECT ruang_poli.id_ruang_poli, ruang_poli.nama_ruang_poli, ruang_poli.gambar_ruang_poli, COALESCE(jumlah_pendaftar, 0) AS jumlah_pendaftar FROM ruang_poli 
    LEFT JOIN (SELECT id_ruang_poli, COUNT(id_pendaftaran) AS jumlah_pendaftar FROM pendaftaran WHERE tanggal_daftar = '$register_date' AND status_pendaftaran = 'Menunggu' GROUP BY id_ruang_poli) 
    AS pendaftar ON ruang_poli.id_ruang_poli = pendaftar.id_ruang_poli WHERE ruang_poli.status_ruang_poli = 'Aktif'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        if ($tersedia === 0) {
            echo "
            <div class='card my-animation-poly' style='width: 18rem;'>
                <div class='card-body'>
                    <h5 class='card-title text-dark-emphasis fs-6'>" . $row['nama_ruang_poli'] . "</h5>
                    <img src='admin/assets/images/" . $row['gambar_ruang_poli'] . "' class='card-img-top img-fluid' alt='" . $row['nama_ruang_poli'] . "' loading='lazy'>
                    <p class='card-text text-secondary fs-7 mb-0'>Jumlah antrian : " . $row['jumlah_pendaftar'] . "</p>
                    <p class='card-text text-secondary fs-7 mb-0'>Antrian yang telah dilayani : 9999</p>
                    <p class='card-text text-secondary fs-7'>Sisa antrian : 9999</p>
                    <button type='button' class='btn btn-sm btn-success' disabled>Daftar</button>
                </div>
            </div>
        ";
        } else {
            echo "
            <div class='card my-animation-poly' style='width: 18rem;'>
                <div class='card-body'>
                    <h5 class='card-title text-dark-emphasis fs-6'>" . $row['nama_ruang_poli'] . "</h5>
                    <img src='admin/assets/images/" . $row['gambar_ruang_poli'] . "' class='card-img-top img-fluid' alt='" . $row['nama_ruang_poli'] . "' loading='lazy'>
                    <p class='card-text text-secondary fs-7 mb-0'>Jumlah antrian : " . $row['jumlah_pendaftar'] . "</p>
                    <p class='card-text text-secondary fs-7 mb-0'>Antrian yang telah dilayani : 9999</p>
                    <p class='card-text text-secondary fs-7'>Sisa antrian : 9999</p>
                    <a href='registration.php?treatmentdate=" . $register_date . "&queuenumber=" . $queue_number . "&idruang=" . $row['id_ruang_poli'] . "' class='btn btn-sm btn-success'>Daftar</a>
                </div>
            </div>
        ";
        }
    }
    ?>
</div>

<?php
include("views/footer.php");
