<?php
$title = "Tambah Anggota Keluarga";
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
if ($result->num_rows > 0) $data = $result->fetch_assoc();

$agama = array("---", "Budha", "Islam", "Hindu", "Katolik", "Konghucu", "Kristen");
$status_hubungan = array("---", "Kepala Keluarga", "Istri", "Anak 1", "Anak 2", "Anak 3", "Anak 4", "Anak 5", "Anak 6", "Anak 7", "Anak 8", "Anak 9");

include("views/header.php");

?>

<div class="mx-3 my-mtb-body">
    <div class="container shadow-sm rounded border py-3">
        <h1 class="text-dark-emphasis fs-6 text-center mb-5">Tambah Anggota Keluarga</h1>
        <p id="alert" class="bg-danger px-2 py-1 text-white fs-7 rounded" style="display: none;">Pesan keberhasilan dan kegagalan</p>
        <?php
        if (isset($_SESSION['error_msg'])) {
            echo "<p class='bg-danger px-2 py-1 text-white fs-7 rounded'>" . $_SESSION['error_msg'] . "</p>";
            unset($_SESSION['error_msg']);
        }
        ?>
        <form action="action.php" method="post" enctype="multipart/form-data" onsubmit="return validasiTambahAnggota()">
            <div class="d-flex justify-content-between col-12 flex-wrap">
                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Identitas Anggota Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK <span class="text-danger">*</span></label>
                        <p class="text-dark-emphasis mb-0"><?= $dec_nik ?></p>
                        <input type="hidden" name="nik" value="<?= $dec_nik ?>">
                    </div>
                    <div class="col-12">
                        <label for="namaDepan" class="form-label form-label-sm fs-7">Nama Depan <span class="text-danger">*</span></label>
                        <?php
                        if (isset($data)) echo "<input type='text' class='form-control form-control-sm fs-7' name='nama_depan' id='namaDepan' value='" . $data['nama_depan'] . "' required autocomplete='off'>";
                        else echo "<input type='text' class='form-control form-control-sm fs-7' name='nama_depan' id='namaDepan' placeholder='Dewi Sari' required autocomplete='off'>";
                        ?>
                    </div>
                    <div class="col-12">
                        <label for="namaBelakang" class="form-label form-label-sm fs-7">Nama Belakang</label>
                        <?php
                        if (isset($data)) echo "<input type='text' class='form-control form-control-sm fs-7' name='nama_belakang' id='namaBelakang' value='" . $data['nama_belakang'] . "' autocomplete='off'>";
                        else echo "<input type='text' class='form-control form-control-sm fs-7' name='nama_belakang' id='namaBelakang' placeholder='Pramudita' autocomplete='off'>";
                        ?>

                    </div>
                    <div class="col-12">
                        <label for="tempatLahir" class="form-label form-label-sm fs-7">Tempat Lahir <span class="text-danger">*</span></label>
                        <?php
                        if (isset($data)) echo "<input type='text' class='form-control form-control-sm fs-7' name='tempat_lahir' id='tempatLahir' value='" . $data['tempat_lahir'] . "' required autocomplete='off'>";
                        else echo "<input type='text' class='form-control form-control-sm fs-7' name='tempat_lahir' id='tempatLahir' placeholder='Pontianak' required autocomplete='off'>";
                        ?>
                    </div>
                    <div class="col-12">
                        <label for="tanggalLahir" class="form-label form-label-sm fs-7">Tanggal Lahir <span class="text-danger">*</span></label>
                        <?php
                        if (isset($data)) echo "<input type='date' class='form-control form-control-sm fs-7' name='tanggal_lahir' id='tanggalLahir' value='" . $data['tanggal_lahir'] . "' required>";
                        else echo "<input type='date' class='form-control form-control-sm fs-7' name='tanggal_lahir' id='tanggalLahir' required>";
                        ?>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Sosial Anggota Keluarga</h2>
                    <div class="col-12">
                        <label for="jenisKelamin" class="form-label form-label-sm fs-7">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm fs-7" name="jenis_kelamin" id="jenisKelamin" required>
                            <?php
                            if (isset($data)) {
                                echo "<option value='" . $data['jenis_kelamin'] . "' hidden>" . $data['jenis_kelamin'] . "</option>";
                                echo "<option value='Laki-Laki'>Laki-Laki</option>";
                                echo "<option value='Perempuan'>Perempuan</option>";
                            } else {
                                echo "<option value='---' hidden>Silakan pilih jenis kelamin</option>";
                                echo "<option value='Laki-Laki'>Laki-Laki</option>";
                                echo "<option value='Perempuan'>Perempuan</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="agama" class="form-label form-label-sm fs-7">Agama <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm fs-7" name="agama" id="agama" required>
                            <?php
                            if (isset($data)) {
                                echo "<option value='" . $data['agama'] . "' hidden>" . $data['agama'] . "</option>";
                                foreach ($agama as $value) {
                                    if ($value === "---") echo "<option value='" . $value . "' hidden>Silakan pilih agama</option>";
                                    else echo "<option value='" . $value . "'>" . $value . "</option>";
                                }
                            } else {
                                foreach ($agama as $value) {
                                    if ($value === "---") echo "<option value='" . $value . "' hidden>Silakan pilih agama</option>";
                                    else echo "<option value='" . $value . "'>" . $value . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="pekerjaan" class="form-label form-label-sm fs-7">Pekerjaan <span class="text-danger">*</span></label>
                        <?php
                        if (isset($data)) echo "<input type='text' class='form-control form-control-sm fs-7' name='pekerjaan' id='pekerjaan' value='" . $data['pekerjaan'] . "' required autocomplete='off'>";
                        else echo "<input type='text' class='form-control form-control-sm fs-7' name='pekerjaan' id='pekerjaan' placeholder='Dokter Umum' required autocomplete='off'>";
                        ?>
                    </div>
                    <div class="col-12">
                        <label for="statusHubungan" class="form-label form-label-sm fs-7">Status Hubungan <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm fs-7" name="status_hubungan" id="statusHubungan" required>
                            <?php
                            foreach ($status_hubungan as $value) {
                                if ($value === "---") echo "<option value='" . $value . "' hidden>Silakan pilih status hubungan</option>";
                                else echo "<option value='" . $value . "'>" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Kontak Anggota Keluarga</h2>
                    <div class="col-12">
                        <label for="noHp" class="form-label form-label-sm fs-7">No. HP</label>
                        <?php
                        if (isset($data)) echo "<input type='number' class='form-control form-control-sm fs-7' name='no_hp' id='noHp' value='" . $data['no_hp'] . "' autocomplete='off'>";
                        else echo "<input type='number' class='form-control form-control-sm fs-7' name='no_hp' id='noHp' placeholder='6285312987634' autocomplete='off'>";
                        ?>
                    </div>
                    <h2 class="text-dark-emphasis fs-7 mb-0 mt-2">Data Pendukung</h2>
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
                            echo "<br /><button type='button' class='btn btn-sm btn-outline-success fs-7' data-bs-toggle='modal' data-bs-target='#ktp'>Lihat KTP</button>";
                            echo "</div>";
                        }
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
                                    <img src="assets/patient_data/<?= $data['ktp'] ?>" class="img-fluid" width="800" alt="kk" />
                                    <input type="hidden" name="prev_ktp" value="<?= $data['ktp'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal ends -->
                    <div class="col-12 mb-4">
                        <label for="ktp" class="form-label form-label-sm fs-7">Kartu Tanda Penduduk</label>
                        <input type="file" class="form-control form-control-sm fs-7" name="ktp" id="ktp">
                        <?php
                        if (isset($data)) echo "<p class='fs-7 fst-italic text-secondary m-0'>*Kosongkan field ini jika KTP tidak diperbarui</p>"
                        ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-sm btn-success" name="tambah_anggota">Simpan</button>
                <a href="family-members.php" class="btn btn-sm btn-outline-success d-block">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php
include("views/footer.php");
