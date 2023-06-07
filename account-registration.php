<?php
$title = "Daftar Pasien Baru";
include("action.php");
include("views/header.php");

$agama = array("---", "Budha", "Islam", "Hindu", "Katolik", "Konghucu", "Kristen");
$status_hubungan = array("---", "Suami", "Istri", "Anak 1", "Anak 2", "Anak 3", "Anak 4", "Anak 5", "Anak 6", "Anak 7", "Anak 8", "Anak 9");
?>
<!-- body starts -->
<div class="container my-mtb-body shadow-sm rounded border py-3">
    <h1 class="text-dark-emphasis fs-6 text-center mb-5">Daftar Pasien Baru</h1>
    <!-- <p class="bg-danger p-1 text-white fs-7 rounded">Pesan keberhasilan dan kegagalan</p> -->
    <div class="d-flex justify-content-between col-12 flex-wrap">
        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7">Data Identitas Kepala Keluarga</h2>
            <div class="col-12 fs-7">
                <label for="no_kk" class="form-label form-label-sm text-dark-emphasis">Nomor KK <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="no_kk" id="no_kk" placeholder="7383091434760008" required>
            </div>
            <div class="col-12 fs-7">
                <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nik" id="nik" placeholder="2151331605010002" required>
            </div>
            <div class="col-12 fs-7">
                <label for="nama_depan" class="form-label form-label-sm text-dark-emphasis">Nama Depan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nama_depan" id="nama_depan" placeholder="Fachri Andika" required>
            </div>
            <div class="col-12 fs-7">
                <label for="nama_belakang" class="form-label form-label-sm text-dark-emphasis">Nama Belakang</label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nama_belakang" id="nama_belakang" placeholder="Permana">
            </div>
            <div class="col-12 fs-7">
                <label for="tempat_lahir" class="form-label form-label-sm text-dark-emphasis">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="tempat_lahir" id="tempat_lahir" placeholder="Pontianak" required>
            </div>
            <div class="col-12 my-gap-6 fs-7">
                <label for="tanggal_lahir" class="form-label form-label-sm text-dark-emphasis">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-sm text-dark-emphasis" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7">Data Sosial Kepala Keluarga</h2>
            <div class="col-12 fs-7">
                <label for="jenis_kelamin" class="form-label form-label-sm text-dark-emphasis">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm text-dark-emphasis" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="" selected>---</option>
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
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="pekerjaan" id="pekerjaan" placeholder="PNS Guru" required>
            </div>
            <h2 class="text-dark-emphasis fs-7 mt-4">Data Kontak Kepala Keluarga</h2>
            <div class="col-12 fs-7">
                <label for="no_hp" class="form-label form-label-sm text-dark-emphasis">No. HP <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="no_hp" id="no_hp" placeholder="6281365300180" required>
            </div>
            <div class="col-12 my-gap-6 fs-7">
                <label for="email" class="form-label form-label-sm text-dark-emphasis">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-sm text-dark-emphasis" name="email" id="email" placeholder="fachriandikap@gmail.com" required>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7">Data Domisili</h2>
            <div class="col-12 fs-7">
                <label for="alamat" class="form-label form-label-sm text-dark-emphasis">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control form-control-sm text-dark-emphasis" name="alamat" id="alamat" rows="3" placeholder="Jalan Pangeran Nata Kusuma No. 76" required></textarea>
            </div>
            <div class="col-12 fs-7">
                <label for="rt" class="form-label form-label-sm text-dark-emphasis">RT <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="rt" id="rt" placeholder="004" required>
            </div>
            <div class="col-12 fs-7">
                <label for="rw" class="form-label form-label-sm text-dark-emphasis">RW <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="rw" id="rw" placeholder="023" required>
            </div>
            <div class="col-12 fs-7">
                <label for="kel_desa" class="form-label form-label-sm text-dark-emphasis">Kelurahan / Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="kel_desa" id="kel_desa" placeholder="Sungai Bangkong" required>
            </div>
            <div class="col-12 fs-7">
                <label for="kecamatan" class="form-label form-label-sm text-dark-emphasis">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm text-dark-emphasis" name="kecamatan" id="kecamatan" placeholder="Pontianak Kota" required>
            </div>

            <h2 class="text-dark-emphasis fs-7 mt-4">Data Pendukung</h2>
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
        <button type="submit" class="btn btn-sm btn-success">Daftar</button>
    </div>
</div>
<!-- body ends -->
<?php
include("views/footer.php");
