<?php
$title = "Informasi Kegiatan";
include("action.php");

if (isset($_GET['idInformasi'])) {
    $enc_id_informasi = $_GET['idInformasi'];
    $dec_id_informasi = decrypt($enc_id_informasi);
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

$hari = array("1" => "Senin", "2" => "Selasa", "3" => "Rabu", "4" => "Kamis", "5" => "Jumat", "6" => "Sabtu", "7" => "Minggu");

$sql = "SELECT * FROM informasi INNER JOIN petugas ON informasi.username = petugas.username 
        INNER JOIN dokter ON informasi.id_dokter = dokter.id_dokter WHERE id_informasi = '$dec_id_informasi' ORDER BY tanggal_unggah";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

include("views/header.php");
?>

<!-- body starts  -->
<div class="my-mtb-body mx-3">
    <div class="container  my-p-body shadow-sm border rounded" id="information">
        <h2 class="text-center text-dark-emphasis mb-3 fs-6"><?= $data['judul'] ?></h2>
        <div class="text-center border-bottom mb-4">
            <?php
            if ($data['tanggal_ubah'] === NULL || $data['tanggal_ubah'] === "") echo "<p class='text-dark-emphasis fs-7'>Diunggah pada: " . $data['tanggal_unggah'] . "</p>";
            else echo "<p class='text-dark-emphasis fs-7'>Diedit pada: " . date('d-m-Y, H:i', strtotime($data['tanggal_ubah'])) . "</p>";
            ?>
        </div>
        <div class="d-flex justify-content-lg-around justify-content-md-center justify-content-sm-center flex-wrap">
            <div class="col-lg-4 col-sm-12 col-md-7 mb-4">
                <img src="admin/assets/images/<?= $data['gambar'] ?>" alt="information's photo" class="img-fluid">
            </div>
            <div class="text-secondary col-lg-7 col-sm-12 col-md-12 fs-7">
                <p><?= $data['deskripsi'] ?></p>
                <?php
                $tanggal = date('N', strtotime($data['tanggal']));
                foreach ($hari as $x => $value) {
                    if ($tanggal == $x) $hari2 = $value;
                }
                ?>
                <p>Hari: <?= $hari2 . ", " . format_date($data['tanggal']) ?></p>
                <p>Jam: <?= $data['jam_mulai'] ?> sampai <?= $data['jam_selesai'] ?></p>
                <p>Dokter: <?= $data['nama_dokter'] ?></p>
            </div>
        </div>
        <div class="text-center border-top">
            <p class="text-dark-emphasis mb-0 mt-4 fs-7">Diunggah oleh: <?= $data['nama_depan'] ?></p>
        </div>
    </div>
</div>

<!-- body ends -->
<?php
include("views/footer.php");
