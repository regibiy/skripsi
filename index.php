<?php
$title = "UPT Puskesmas Alianyang";
include("action.php");
include("views/header.php");
?>

<!-- main starts -->
<?php
if (check_status_login_pasien()) {
?>
    <div class="text-center my-mtb-body">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <div class="main p-2 col-lg-12 col-sm-12 col-md-12">
                <h1 class="greeting text-dark-emphasis fs-4">......</h1>
                <p class="text-dark-emphasis mb-0">Informasi terbaru seputar kegiatan di UPT Puskesmas Alianyang</p>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="text-center my-pt-main">
        <div class="container d-flex flex-wrap justify-content-center align-items-center">
            <div class="main p-2 col-lg-9 col-sm-12 col-md-12">
                <h1 class="fs-5 text-light mb-4">Ujung Tombak Pembangunan Kesehatan</h1>
                <p class="text-light mb-0 fs-6">Selamat datang di web Puskesmas Alianyang! Melalui web ini, Anda dapat mendaftarkan diri dan keluarga Anda untuk mendapatkan akses ke berbagai layanan kesehatan yang tersedia di Puskesmas kami.</p>
            </div>
            <div class="login bg-white rounded shadow-sm border mb-3 mt-3 col-lg-3 col-12 col-md-7">
                <form action="action.php" method="post">
                    <h1 class="mb-3 text-dark-emphasis fs-6">Masuk</h1>
                    <?php
                    if (isset($_SESSION['error_msg'])) {
                        echo "<p class='bg-danger text-white p-1 rounded fs-7'>" . $_SESSION['error_msg'] . "</p>";
                        unset($_SESSION['error_msg']);
                    }
                    ?>
                    <div class="form-floating mb-3">
                        <?php
                        if (isset($_SESSION['no_berobat']) && !check_status_login_pasien()) {
                            echo "<input type='number' class='form-control form-control-sm' id='floatingInput' name='no_berobat' value='" . $_SESSION['no_berobat'] . "'>";
                            unset($_SESSION['no_berobat']);
                        } else {
                            echo "<input type='number' class='form-control form-control-sm' id='floatingInput' name='no_berobat' placeholder='123456' min='0'>";
                        }
                        ?>
                        <label for="floatingInput" class="form-label form-label-sm fs-7">Nomor Berobat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-control-sm" id="floatingPassword" name="password" placeholder="******">
                        <label for="floatingPassword" class="form-label form-label-sm fs-7">Kata Sandi</label>
                        <div class="form-check text-start mt-1">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault" onclick="showPassword()">
                            <label class="form-check-label text-dark-emphasis fs-7" for="flexCheckDefault">Lihat Kata Sandi</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success" name="login">Masuk</button>
                </form>
                <p class="mt-3 mb-0 text-dark-emphasis fs-7">Lupa akun? Klik di <a href="forgot-account.php" class="text-decoration-none">sini!</a></p>
                <p class="mt-3 mb-0 text-dark-emphasis fs-7">Belum memiliki akun? Klik di <a href="account-registration.php" class="text-decoration-none">sini!</a></p>
            </div>
        </div>
    </div>
<?php
}
?>
<!-- main ends -->

<!-- body starts  -->
<?php
if (!check_status_login_pasien()) {
?>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 150" id="information">
        <path fill="#2cc185" fill-opacity="1" d="M0,64L80,80C160,96,320,128,480,117.3C640,107,800,53,960,42.7C1120,32,1280,64,1360,80L1440,96L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
    </svg>
<?php
}
?>
<div class="container information">
    <?php
    if (!check_status_login_pasien()) echo "<h2 class='text-center text-dark-emphasis mb-4 fs-5' id='information'>Informasi Kegiatan Kami</h2>";
    ?>
    <?php
    $hari = array("1" => "Senin", "2" => "Selasa", "3" => "Rabu", "4" => "Kamis", "5" => "Jumat", "6" => "Sabtu", "7" => "Minggu");
    $sql = "SELECT * FROM informasi INNER JOIN petugas ON informasi.username = petugas.username ORDER BY tanggal_unggah DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col'>";
            echo "<div class='card shadow-sm'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title text-dark-emphasis fs-6'>" . $row['judul'] . "</h5>";
            $deskripsi = $row['deskripsi'];
            $kata = str_word_count($deskripsi, 1); //https://www.php.net/manual/en/function.str-word-count.php
            $kataFiltered = array_filter($kata, function ($kata2) {
                return $kata2 !== "br";
            });
            $rangkai = implode(' ', array_slice($kataFiltered, 0, 20));
            echo "<p class='card-text text-secondary fs-7'>" . $rangkai . "</p>";
            $tanggal = date('N', strtotime($row['tanggal']));
            foreach ($hari as $x => $val) {
                if ($tanggal == $x) $hari2 = $val;
            }
            echo "<p class='card-text text-secondary fs-7'>Hari: " . $hari2 . ", " . format_date($row['tanggal']) . "</p>";
            echo "<p class='card-text text-secondary fs-7'>Jam: " . $row['jam_mulai'] . " sampai " . $row['jam_selesai'] . "</p>";
            $enc_id_informasi = encrypt($row['id_informasi']);
            $url = "information.php?idInformasi=" . urlencode($enc_id_informasi);
            echo "<a class='text-decoration-none fs-7' href='" . $url . "'>Selengkapnya...</a>";
            echo "</div>";
            echo "<div class='card-footer'>";
            if ($row['tanggal_ubah'] === NULL || $row['tanggal_ubah'] === "") echo "<small class='text-body-secondary fs-7'>Diunggah pada " . date('d-m-Y, H:i', strtotime($row['tanggal_unggah'])) . " oleh " . $row['nama_depan'] . "</small>";
            else echo "<small class='text-body-secondary fs-7'>Diedit pada " . date('d-m-Y, H:i', strtotime($row['tanggal_ubah'])) . " oleh " . $row['nama_depan'] . "</small>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
    ?>
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <img src="assets/images/no_data.jpg" alt="Belum ada informasi" class="img-fluid" width="500">
            <p class="fs-4">Upss...</p>
            <p class="fs-7 m-0">Belum ada informasi kegiatan yang dibagikan oleh petugas kami.</p>
            <p class="fs-7">Jangan khawatir. ketika ada informasi kegiatan yang akan dilaksanakan, petugas kami akan segera membagikannya disini.</p>
        </div>
    <?php
    }
    ?>
</div>
<!-- body ends -->
<?php
include("views/footer.php");
