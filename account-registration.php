<?php
$title = "Daftar Pasien Baru";
include("action.php");
include("views/header.php");

$agama = array("---", "Budha", "Islam", "Hindu", "Katolik", "Konghucu", "Kristen");
$status_hubungan = array("---", "Kepala Keluarga", "Istri", "Anak 1", "Anak 2", "Anak 3", "Anak 4", "Anak 5", "Anak 6", "Anak 7", "Anak 8", "Anak 9");
?>
<!-- body starts -->
<div class="mx-3 my-mtb-body">
    <form action="action.php" method="post" enctype="multipart/form-data" onsubmit="return validasiFormDaftar()">
        <div class="container shadow-sm rounded border py-3">
            <h1 class="text-dark-emphasis fs-6 text-center mb-5">Daftar Pasien Baru</h1>
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
            <div class="d-flex justify-content-between col-12 flex-wrap p-2">
                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Identitas Kepala Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="noKk" class="form-label form-label-sm text-dark-emphasis">Nomor KK <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="no_kk" id="noKk" placeholder="7383091434760008" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="nik" id="nik" placeholder="2151331605010002" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="namaDepan" class="form-label form-label-sm text-dark-emphasis">Nama Depan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nama_depan" id="namaDepan" placeholder="Fachri Andika" maxlength="30" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="namaBelakang" class="form-label form-label-sm text-dark-emphasis">Nama Belakang</label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nama_belakang" id="namaBelakang" placeholder="Permana" maxlength="30">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="tempatLahir" class="form-label form-label-sm text-dark-emphasis">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="tempat_lahir" id="tempatLahir" placeholder="Pontianak" maxlength="30" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="tanggalLahir" class="form-label form-label-sm text-dark-emphasis">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm text-dark-emphasis" name="tanggal_lahir" id="tanggalLahir" required>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                    <h2 class="text-dark-emphasis fs-7 m-0">Data Sosial Kepala Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="jenisKelamin" class="form-label form-label-sm text-dark-emphasis">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm text-dark-emphasis" name="jenis_kelamin" id="jenisKelamin" required>
                            <option value="---" selected>---</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="agama" class="form-label form-label-sm text-dark-emphasis">Agama <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm text-dark-emphasis" name="agama" id="agama" required>
                            <?php
                            foreach ($agama as $value) {
                                echo "<option value=" . $value . ">" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="pekerjaan" class="form-label form-label-sm text-dark-emphasis">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="pekerjaan" id="pekerjaan" placeholder="PNS Guru" maxlength="25" required>
                    </div>
                    <h2 class="text-dark-emphasis fs-7 mt-2 mb-0">Data Kontak Kepala Keluarga</h2>
                    <div class="col-12 fs-7">
                        <label for="noHp" class="form-label form-label-sm text-dark-emphasis">No. HP <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="no_hp" id="noHp" placeholder="6281365300180" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="email" class="form-label form-label-sm text-dark-emphasis">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-sm text-dark-emphasis" name="email" id="email" placeholder="fachriandikap@gmail.com" required>
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
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="rt" id="rt" placeholder="004" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="rw" class="form-label form-label-sm text-dark-emphasis">RW <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm text-dark-emphasis" name="rw" id="rw" placeholder="023" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="kelDesa" class="form-label form-label-sm text-dark-emphasis">Kelurahan / Desa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="kel_desa" id="kelDesa" placeholder="Sungai Bangkong" maxlength="30" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="kecamatan" class="form-label form-label-sm text-dark-emphasis">Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm text-dark-emphasis" name="kecamatan" id="kecamatan" placeholder="Pontianak Kota" maxlength="40" required>
                    </div>

                    <h2 class="text-dark-emphasis fs-7 mt-2 mb-0">Data Pendukung</h2>
                    <div class="col-12 fs-7">
                        <label for="ktp" class="form-label form-label-sm text-dark-emphasis">Kartu Tanda Penduduk Kepala Keluarga <span class="text-danger">*</span></label>
                        <input type="file" class="form-control form-control-sm text-dark-emphasis" name="ktp" id="ktp" required>
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
        </div>
    </form>
</div>
<!-- body ends -->
<?php
include("views/footer.php");
