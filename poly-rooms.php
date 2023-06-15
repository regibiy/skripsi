<?php
$title = "Ruang Poli";
include("action.php");
if (!check_status_login_pasien()) {
    $_SESSION['error_msg'] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}
include("views/header.php");
?>

<div class="text-center my-mtb-body">
    <div class="container d-flex flex-wrap justify-content-center align-items-center">
        <div class="col-12 text-dark-emphasis">
            <h1 class="greeting fs-4">......</h1>
            <p>Informasi ruang poli dan pendaftaran di UPT Puskesmas Alianyang</p>
            <?php
            $result = get_data("kuota");
            $data = $result->fetch_assoc();
            echo "<p class='fs-7'>Kuota Tersedia: <span class='fw-medium'>" . $data['kuota_tersedia'] . "</span> dari <span class='fw-medium'>" . $data['kuota_tersedia'] . "</span></p>";
            ?>
            <form action="action.php" method="post" onsubmit="return validasiTanggalDaftar()">
                <div class="row g-3 align-items-center justify-content-center fs-7">
                    <div class="col-auto">
                        <label for="registerDate" class="col-form-label col-form-label-sm">Tanggal</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" id="registerDate" name="register_date" class="form-control form-control-sm">
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

<div class="container d-flex justify-content-center flex-wrap gap-4">
    <?php
    $sql = "SELECT * FROM ruang_poli WHERE status_ruang_poli = 'Aktif'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "
            <div class='card my-animation-poly' style='width: 18rem;'>
                <div class='card-body'>
                    <h5 class='card-title text-dark-emphasis fs-6'>" . $row['nama_ruang_poli'] . "</h5>
                    <img src='admin/assets/images/" . $row['gambar_ruang_poli'] . "' class='card-img-top img-fluid' alt='" . $row['nama_ruang_poli'] . "'>
                    <p class='card-text text-secondary fs-7 mb-0'>Jumlah antrian : 9999</p>
                    <p class='card-text text-secondary fs-7 mb-0'>Antrian yang telah dilayani : 9999</p>
                    <p class='card-text text-secondary fs-7'>Sisa antrian : 9999</p>
                    <a href='registration.php' class='btn btn-sm btn-success'>Daftar</a>
                </div>
            </div>
        ";
    }
    ?>
</div>

<?php
include("views/footer.php");
