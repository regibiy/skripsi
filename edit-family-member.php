<?php
$title = "Edit Anggota Keluarga";
include("action.php");

if (isset($_GET['nik'])) {
    $enc_nik = $_GET['nik'];
    $dec_nik = decrypt($enc_nik);
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

$sql = "SELECT * FROM pasien WHERE nik = '$dec_nik'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$agama = array("Budha", "Islam", "Hindu", "Katolik", "Konghucu", "Kristen");
$status_hubungan = array("Kepala Keluarga", "Istri", "Anak 1", "Anak 2", "Anak 3", "Anak 4", "Anak 5", "Anak 6", "Anak 7", "Anak 8", "Anak 9");
$jenis_kelamin = array("Laki-Laki", "Perempuan");
$status_pasien = array("Dalam KK", "Luar KK");

include("views/header.php");
?>
<div class="mx-3 my-mtb-body">
    <div class="container shadow-sm rounded border py-3">
        <h1 class="text-dark-emphasis fs-6 text-center mb-5">Edit Anggota Keluarga</h1>
        <?php
        if (isset($_SESSION['error_msg'])) {
            echo "<p class='bg-danger rounded fs-7 text-white px-2 py-1'>" . $_SESSION['error_msg'] . "</p>";
            unset($_SESSION['error_msg']);
        }
        ?>
        <form action="action.php" method="post" enctype="multipart/form-data" onsubmit="return validasiEditAnggota()">
            <div class="d-flex justify-content-between col-12 flex-wrap">
                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Identitas Anggota Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK <span class="text-danger">*</span></label>
                        <p class="text-dark-emphasis mb-0"><?= $data['nik'] ?></p>
                        <input type="hidden" name="nik" value="<?= $data['nik'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="nama_depan" class="form-label form-label-sm fs-7">Nama Depan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm fs-7" name="nama_depan" id="nama_depan" value="<?= $data['nama_depan'] ?>" required autocomplete="off">
                    </div>
                    <div class="col-12">
                        <label for="nama_belakang" class="form-label form-label-sm fs-7">Nama Belakang</label>
                        <input type="text" class="form-control form-control-sm fs-7" name="nama_belakang" id="nama_belakang" value="<?= $data['nama_belakang'] ?>" autocomplete="off">
                    </div>
                    <div class="col-12">
                        <label for="tempat_lahir" class="form-label form-label-sm fs-7">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm fs-7" name="tempat_lahir" id="tempat_lahir" value="<?= $data['tempat_lahir'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="tanggal_lahir" class="form-label form-label-sm fs-7">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm fs-7" name="tanggal_lahir" id="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" required>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Sosial Anggota Keluarga</h2>
                    <div class="col-12">
                        <label for="jenis_kelamin" class="form-label form-label-sm fs-7">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm fs-7" name="jenis_kelamin" id="jenis_kelamin" required>
                            <?php
                            foreach ($jenis_kelamin as $value_jk) {
                                $selected_jk = ($value_jk === $data['jenis_kelamin']) ? "selected" : "";
                                echo "<option value='" . $value_jk . "' . " . $selected_jk . ">" . $value_jk . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="agama" class="form-label form-label-sm fs-7">Agama <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm fs-7" name="agama" id="agama" required>
                            <?php
                            foreach ($agama as $value_agama) {
                                $selected_agama = ($value_agama === $data['agama']) ? "selected" : "";
                                echo "<option value='" . $value_agama . "' . " . $selected_agama . ">" . $value_agama . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="pekerjaan" class="form-label form-label-sm fs-7">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm fs-7" name="pekerjaan" id="pekerjaan" value="<?= $data['pekerjaan'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="status_hubungan" class="form-label form-label-sm fs-7">Status Hubungan <span class="text-danger">*</span></label>
                        <input type="hidden" name="status_hubungan_prev" value="<?= $data['status_hubungan'] ?>">
                        <select class="form-select form-select-sm fs-7" name="status_hubungan" id="status_hubungan" required>
                            <?php
                            foreach ($status_hubungan as $value_sh) {
                                $selected_sh = ($value_sh === $data['status_hubungan']) ? "selected" : "";
                                echo "<option value='" . $value_sh . "' . " . $selected_sh . ">" . $value_sh . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="statusPasien" class="form-label form-label-sm fs-7">Status Pasien <span class="text-danger">*</span></label>
                        <input type="hidden" name="status_pasien_prev" value="<?= $data['status_pasien'] ?>">
                        <select class="form-select form-select-sm fs-7" name="status_pasien" id="statusPasien" required>
                            <?php
                            foreach ($status_pasien as $value_sp) {
                                $selected_sp = ($value_sp === $data['status_pasien']) ? "selected" : "";
                                echo "<option value'" . $value_sp . "' . " . $selected_sp . ">" . $value_sp . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Kontak Anggota Keluarga</h2>
                    <div class="col-12">
                        <label for="noHp" class="form-label form-label-sm fs-7">No. HP</label>
                        <input type="number" class="form-control form-control-sm fs-7" name="no_hp" id="noHp" value="<?= $data['no_hp'] ?>" autocomplete="off">
                    </div>
                    <h2 class="text-dark-emphasis fs-7 mt-2 mb-0">Data Pendukung</h2>
                    <?php
                    if ($data['ktp'] === NULL || $data['ktp'] === "") {
                        echo "<div class='col-12 gap-3'>";
                        echo "<label for='ktp' class='form-label form-label-sm fs-7'>Kartu Tanda Penduduk Saat Ini</label>";
                        echo "<p class='m-0 fs-7'>" . $data['nama_depan'] .  " belum memiliki KTP</p>";
                        echo "</div>";
                    } else {
                        echo "<div class='col-12 gap-3'>";
                        echo "<label for='ktp' class='form-label form-label-sm fs-7'>Kartu Tanda Penduduk Saat Ini</label>";
                        echo "<br /><button type='button' class='btn btn-sm btn-outline-success fs-7' data-bs-toggle='modal' data-bs-target='#ktp'>Lihat KTP</button>";
                        echo "</div>";
                    }
                    ?>
                    <!-- Modal starts-->
                    <div class="modal fade" id="ktp" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7">KTP <?= $data['nama_depan'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="assets/patient_data/<?= $data['ktp'] ?>" class="img-fluid" width="800" alt="ktp" />
                                    <input type="hidden" name="prev_ktp" value="<?= $data['ktp'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal ends -->
                    <div class="col-12 mb-4">
                        <label for="ktp" class="form-label form-label-sm fs-7">Kartu Tanda Penduduk</label>
                        <input type="file" class="form-control form-control-sm fs-7" name="ktp" id="ktp">
                        <p class="fs-7 fst-italic text-secondary m-0">*Kosongkan field ini jika KTP tidak diperbarui</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-sm btn-success" name="edit_anggota">Simpan</button>
                <a href="family-members.php" class="btn btn-sm btn-outline-success d-block">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php
include("views/footer.php");
