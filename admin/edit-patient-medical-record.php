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

if (isset($_GET['nik'])) {
    $enc_nik = $_GET['nik'];
    $dec_nik = decrypt($enc_nik);
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

$sql = "SELECT * FROM pasien INNER JOIN rekam_medis ON pasien.nik = rekam_medis.nik WHERE pasien.nik = '$dec_nik'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$agama = array("Budha", "Islam", "Hindu", "Katolik", "Konghucu", "Kristen");
$status_hubungan = array("Kepala Keluarga", "Istri", "Anak 1", "Anak 2", "Anak 3", "Anak 4", "Anak 5", "Anak 6", "Anak 7", "Anak 8", "Anak 9");
$jenis_kelamin = array("Laki-Laki", "Perempuan");
$status_pasien = array("Dalam KK", "Luar KK");

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Edit NIK <?= $data['nik'] ?></p>
        <form action="action-admin.php" method="post">
            <?php
            if (isset($_SESSION['error_msg'])) {
                echo "<p class='bg-danger text-white fs-7 rounded px-2 py-1'>" . $_SESSION['error_msg'] . "</p>";
                unset($_SESSION['error_msg']);
            }
            ?>
            <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
                <div class="col-lg-6 col-12">
                    <table class="table table-borderless">
                        <tr>
                            <td class="col-4"><label for="nik" class="form-label form-label-sm">NIK</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <p class="fs-7 m-0 fw-medium"><?= $data['nik'] ?></p>
                                    <input type="hidden" name="no_kk" value="<?= $data['no_kk'] ?>">
                                    <input type="hidden" name="nik" value="<?= $data['nik'] ?>">
                                    <input type="hidden" name="no_rek_med_prev" value="<?= $data['no_rekam_medis'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="namaDepan" class="form-label form-label-sm">Nama Depan</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm edit-nik-rekmed" name="nama_depan" id="namaDepan" placeholder="Fachri Andika" disabled required autocomplete="off" value="<?= $data['nama_depan'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="namaBelakang" class="form-label form-label-sm">Nama Belakang</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm edit-nik-rekmed" name="nama_belakang" id="namaBelakang" disabled autocomplete="off" value="<?= $data['nama_belakang'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="tempatLahir" class="form-label form-label-sm">Tempat Lahir</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm edit-nik-rekmed" name="tempat_lahir" id="tempatLahir" placeholder="Pontianak" disabled required autocomplete="off" value="<?= $data['tempat_lahir'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="tanggalLahir" class="form-label form-label-sm">Tanggal Lahir</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="date" class="form-control form-control-sm text-dark-emphasis edit-nik-rekmed" name="tanggal_lahir" id="tanggalLahir" disabled required autocomplete="off" value="<?= $data['tanggal_lahir'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="jenisKelamin" class="form-label form-label-sm">Jenis Kelamin</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <select class="form-select form-select-sm text-dark-emphasis edit-nik-rekmed" name="jenis_kelamin" id="jenisKelamin" disabled required>
                                        <?php
                                        foreach ($jenis_kelamin as $value) {
                                            $selected = ($value === $data['jenis_kelamin']) ? "selected" : "";
                                            echo "<option value'" . $value . "' . " . $selected . ">" . $value . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 col-12">
                    <table class="table table-borderless">
                        <tr>
                            <td class="col-4"><label for="agama" class="form-label form-label-sm">Agama</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <select class="form-select form-select-sm text-dark-emphasis edit-nik-rekmed" name="agama" id="agama" disabled required>
                                        <?php
                                        foreach ($agama as $value) {
                                            $selected = ($value === $data['agama']) ? "selected" : "";
                                            echo "<option value='" . $value . "' . " . $selected . ">" . $value . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="pekerjaan" class="form-label form-label-sm">Pekerjaan</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm edit-nik-rekmed" name="pekerjaan" id="pekerjaan" placeholder="PNS Guru" disabled required autocomplete="off" value="<?= $data['pekerjaan'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="status_hubungan" class="form-label form-label-sm">Status Hubungan</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <select class="form-select form-select-sm fs-7 edit-nik-rekmed" name="status_hubungan" id="status_hubungan" disabled required>
                                        <?php
                                        foreach ($status_hubungan as $value) {
                                            $selected = ($value === $data['status_hubungan']) ? "selected" : "";
                                            echo "<option value='" . $value . "' . " . $selected . ">" . $value . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="status_hubungan_prev" value="<?= $data['status_hubungan'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr class="col-4">
                            <td><label for="noHp" class="form-label form-label-sm">Nomor HP</label></td>
                            <td class="fw-medium text-secondary"><?= $data['no_hp'] ?></td>
                        </tr>
                        <tr class="col-4">
                            <td><label for="statusPasien" class="form-label form-label-sm">Status Pasien</label></td>
                            <td class="fw-medium text-secondary">
                                <div class="col-lg-8 col-12">
                                    <input type="hidden" name="status_pasien_prev" value="<?= $data['status_pasien'] ?>">
                                    <select class="form-select form-select-sm fs-7 edit-nik-rekmed" name="status_pasien" id="statusPasien" disabled required>
                                        <?php
                                        foreach ($status_pasien as $value) {
                                            $selected = ($value === $data['status_pasien']) ? "selected" : "";
                                            echo "<option value='" . $value . "' . " . $selected . ">" . $value . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr class="col-4">
                            <td><label for="ktp" class="form-label form-label-sm">KTP</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#ktp">Lihat KTP</button>
                                    <!-- Modal starts-->
                                    <div class="modal fade" id="ktp" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-7" id="exampleModalLabel">KTP <?= $data['nama_depan'] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <?php
                                                if ($data['ktp'] === NULL || $data['ktp'] === "") echo "<div class='modal-body text-center'><p class='fs-7'>" . $data['nama_depan'] . " belum memiliki KTP</p></div>";
                                                else echo "<div class='modal-body text-center'><img src='../assets/patient_data/" . $data['ktp'] . "' class='img-fluid' width='400' alt='KTP " . $data['nama_depan'] . "' /></div>";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal ends -->
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-center col-12 mb-2 gap-3">
                    <button type="button" class="btn btn-sm btn-primary" onclick="editNikDisabled()">Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#warning" id="simpanEditNik" disabled>Simpan</button>
                    <!-- modal edit status starts-->
                    <div class="modal fade" id="warning" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Perhatian</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 fs-7">
                                        <p class="m-0">Pastikan TIDAK ada data yang keliru saat Anda memasukkan atau mengubah data pasien. Apakah Anda ingin melanjutkan?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-sm btn-primary" name="edit_data_nik_rekmed">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal edit status ends -->
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("views/index-footer.php");
