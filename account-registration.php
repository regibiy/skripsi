<?php
$title = "Daftar Pasien Baru";
include("action.php");
include("views/header.php");

if (isset($_GET['nik'])) {
    $enc_nik = $_GET['nik'];
    $dec_nik = decrypt($enc_nik);
    $sql = "SELECT * FROM pasien WHERE nik = '$dec_nik'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) $data = $result->fetch_assoc();
}

$jenis_kelamin = array("---", "Laki-Laki", "Perempuan");
$agama = array("---", "Budha", "Islam", "Hindu", "Katolik", "Konghucu", "Kristen");
$status_hubungan = array("---", "Kepala Keluarga", "Istri", "Anak 1", "Anak 2", "Anak 3", "Anak 4", "Anak 5", "Anak 6", "Anak 7", "Anak 8", "Anak 9");
?>
<!-- body starts -->
<div class="mx-3 my-mtb-body">
    <div class="container shadow-sm rounded border py-3">
        <h1 class="text-dark-emphasis fs-6 mb-5 text-center">
            Daftar Pasien Baru
            <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#nikCheck">Cek NIK</button>
            <!-- modal cek nik starts-->
            <form action="action.php" method="post" onsubmit="return validasiNIK()">
                <div class="modal fade" id="nikCheck" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">NIK</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="restartNIK()"></button>
                            </div>
                            <div class="modal-body">
                                <p id="alertModal" class="bg-danger text-white fs-7 rounded py-1 px-2 text-start fw-normal" style="display: none;"></p>
                                <div class="col-12 fs-7 text-start">
                                    <label for="nikCheckDua" class="form-label form-label-sm">NIK Kepala Keluarga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" name="nik_check" id="nikCheckDua" placeholder="2151331605010002" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal" onclick="restartNIK()">Batal</button>
                                <button type="submit" class="btn btn-sm btn-success" name="cek_nik_daftar">Cek</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- modal cek nik ends -->
        </h1>
        <?php
        if (isset($_SESSION['error_msg'])) {
            echo "<p class='bg-danger p-1 text-white fs-7 rounded'>" . $_SESSION['error_msg'] . "</p>";
            unset($_SESSION['error_msg']);
        } elseif (isset($_SESSION['success_msg'])) {
            echo "<p class='bg-success p-1 text-white fs-7 rounded'>" . $_SESSION['success_msg'] . "</p>";
            unset($_SESSION['success_msg']);
        }
        ?>
        <p id="alert" class="bg-danger p-1 text-white fs-7 rounded" style="display: none;"></p>
        <form action="action.php" method="post" enctype="multipart/form-data" onsubmit="return validasiFormDaftar()">
            <div class="d-flex justify-content-between col-12 flex-wrap p-2">
                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Identitas Kepala Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK <span class="text-danger">*</span></label>
                        <?php
                        if (isset($dec_nik)) echo "<p class='m-0'>" . $dec_nik . "</p>";
                        else echo "<p class='m-0 bg-danger px-2 py-1 rounded text-white'>Silakan cek NIK Anda terlebih dahulu</p>";
                        ?>
                        <input type="hidden" name="nik" value="<?= isset($data) ? $data['nik'] : $dec_nik ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="noKk" class="form-label form-label-sm text-dark-emphasis">Nomor KK <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="no_kk" id="noKk" placeholder="7383091434760008" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="namaDepan" class="form-label form-label-sm text-dark-emphasis">Nama Depan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nama_depan" id="namaDepan" placeholder="Fachri Andika" maxlength="30" required autocomplete="off" value="<?= isset($data) ? $data['nama_depan'] : "" ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="namaBelakang" class="form-label form-label-sm text-dark-emphasis">Nama Belakang</label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nama_belakang" id="namaBelakang" placeholder="Permana" maxlength="30" autocomplete="off" value="<?= isset($data) ? $data['nama_belakang'] : "" ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="tempatLahir" class="form-label form-label-sm text-dark-emphasis">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="tempat_lahir" id="tempatLahir" placeholder="Pontianak" maxlength="30" required autocomplete="off" value="<?= isset($data) ? $data['tempat_lahir'] : "" ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="tanggalLahir" class="form-label form-label-sm text-dark-emphasis">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm text-dark-emphasis" name="tanggal_lahir" id="tanggalLahir" required value="<?= isset($data) ? $data['tanggal_lahir'] : "" ?>">
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Sosial Kepala Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="jenisKelamin" class="form-label form-label-sm text-dark-emphasis">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm text-dark-emphasis" name="jenis_kelamin" id="jenisKelamin" required>
                            <?php
                            if (isset($data)) {
                                foreach ($jenis_kelamin as $value) {
                                    if ($value !== "---") { //menghindari ---
                                        $selected = ($value === $data['jenis_kelamin']) ? "selected" : "";
                                        echo "<option value='" . $value . "' . " . $selected . ">" . $value . "</option>";
                                    }
                                }
                            } else {
                                foreach ($jenis_kelamin  as $value) {
                                    if ($value === "---") echo "<option value='" . $value . "' hidden>Silakan pilih jenis kelamin Anda</option>";
                                    else echo "<option value='" . $value . "'> " . $value . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="agama" class="form-label form-label-sm text-dark-emphasis">Agama <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm text-dark-emphasis" name="agama" id="agama" required>
                            <?php
                            if (isset($data)) {
                                foreach ($agama as $value) {
                                    if ($value !== "---") { //menghindari ---
                                        $selected = ($value === $data['agama']) ? "selected" : "";
                                        echo "<option value='" . $value . "' . " . $selected . ">" . $value . "</option>";
                                    }
                                }
                            } else {
                                foreach ($agama as $value) {
                                    if ($value === "---") echo "<option value='" . $value . "' hidden>Silakan pilih agama Anda</option>";
                                    else echo "<option value='" . $value . "'> " . $value . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="pekerjaan" class="form-label form-label-sm text-dark-emphasis">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="pekerjaan" id="pekerjaan" placeholder="PNS Guru" maxlength="25" required autocomplete="off" value="<?= isset($data) ? $data['pekerjaan'] : "" ?>">
                    </div>
                    <h2 class="text-dark-emphasis fs-7 mt-2 mb-0">Data Kontak Kepala Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="noHp" class="form-label form-label-sm text-dark-emphasis">No. HP <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="no_hp" id="noHp" placeholder="6281365300180" required autocomplete="off" <?= isset($data) ? $data['no_hp'] : "" ?>>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="email" class="form-label form-label-sm text-dark-emphasis">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-sm text-dark-emphasis" name="email" id="email" placeholder="fachriandikap@gmail.com" required autocomplete="off">
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Domisili</h2>
                    <div class="col-12 fs-7">
                        <label for="alamat" class="form-label form-label-sm text-dark-emphasis">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm text-dark-emphasis" name="alamat" id="alamat" rows="3" placeholder="Jalan Pangeran Nata Kusuma No. 76" maxlength="150" required></textarea>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="rt" class="form-label form-label-sm text-dark-emphasis">RT <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="rt" id="rt" placeholder="004" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="rw" class="form-label form-label-sm text-dark-emphasis">RW <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="rw" id="rw" placeholder="023" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="kelDesa" class="form-label form-label-sm text-dark-emphasis">Kelurahan / Desa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="kel_desa" id="kelDesa" placeholder="Sungai Bangkong" maxlength="30" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="kecamatan" class="form-label form-label-sm text-dark-emphasis">Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="kecamatan" id="kecamatan" placeholder="Pontianak Kota" maxlength="40" required autocomplete="off">
                    </div>
                    <h2 class="text-dark-emphasis fs-7 mt-2 mb-0">Data Pendukung</h2>
                    <?php
                    if (isset($data)) {
                        if ($data['ktp'] === NULL || $data['ktp'] === "") {
                            echo "<div class='col-12 gap-3'>";
                            echo "<label for='ktp' class='form-label form-label-sm fs-7'>Kartu Tanda Penduduk Saat Ini</label>";
                            echo "<p class='m-0 fs-7'>" . $data['nama_depan'] .  " belum memiliki KTP</p>";
                            echo "</div>";
                        } else {
                            echo "<div class='col-12 gap-3'>";
                            echo "<label for='ktp' class='form-label form-label-sm fs-7'>Kartu Tanda Penduduk Saat Ini</label>";
                            echo "<br /><button type='button' class='btn btn-sm btn-outline-success fs-7' data-bs-toggle='modal' data-bs-target='#lihatKtp'>Lihat KTP</button>";
                            echo "</div>";
                        }
                    }
                    ?>
                    <!-- Modal starts-->
                    <div class="modal fade" id="lihatKtp" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7">KTP <?= isset($data) ? $data['nama_depan'] : "" ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="assets/patient_data/<?= isset($data) ? $data['ktp'] : "" ?>" class="img-fluid" width="800" alt="ktp" />
                                    <input type="hidden" name="prev_ktp" value="<?= isset($data) ? $data['ktp'] : "" ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal ends -->
                    <div class="col-12 fs-7">
                        <label for="ktp" class="form-label form-label-sm text-dark-emphasis">Kartu Tanda Penduduk Kepala Keluarga <?= !isset($data) ? "<span class='text-danger'>*</span>" : "" ?></label>
                        <input type="hidden" name="ktp_prev" value="<?= $data['ktp'] ?>">
                        <input type="file" class="form-control form-control-sm text-dark-emphasis" name="ktp" id="ktp" <?= !isset($data) ? "required" : "" ?>>
                    </div>
                    <div class="col-12 mb-3 fs-7">
                        <label for="kk" class="form-label form-label-sm text-dark-emphasis">Kartu Keluarga <span class="text-danger">*</span></label>
                        <input type="file" class="form-control form-control-sm text-dark-emphasis" name="kk" id="kk" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-sm btn-success" name="daftar_akun_pasien" id="daftar">Daftar</button>
            </div>
        </form>
    </div>
</div>
<!-- body ends -->
<?php
include("views/footer.php");
