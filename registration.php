<?php
$title = "Pendaftaran";
include("action.php");
include("views/header.php");
?>

<div class="container my-mtb-body shadow-sm rounded border py-3">
    <h1 class="text-dark-emphasis fs-6 text-center mb-5">Selesaikan Pendaftaran</h1>
    <div class="d-flex justify-content-between col-12 flex-wrap">
        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 my-gap-6">
            <h2 class="text-dark-emphasis fs-6 fw-medium mb-0">Data Pendaftaran</h2>
            <div class="col-12">
                <label class="form-label form-label-sm fs-7">Tanggal Daftar</label>
                <p class="text-secondary fs-7 mb-0">dd-mm-yyyy</p>
            </div>
            <div class="col-12">
                <label class="form-label form-label-sm fs-7">Nomor Antrian</label>
                <p class="text-secondary fs-7 mb-0">x-5-x</p>
            </div>
            <div class="col-12">
                <label class="form-label form-label-sm fs-7">Tujuan Ruang Poli</label>
                <p class="text-secondary fs-7 mb-0">x-30-x</p>
            </div>
            <div class="col-12">
                <label class="form-label form-label-sm fs-7">Tanggal Berobat</label>
                <p class="text-secondary fs-7 mb-0">dd-mm-yyyy</p>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 my-gap-6">
            <h2 class="text-dark-emphasis fs-6 fw-medium mb-0">Data Kontak Pasien</h2>
            <p class="text-dark-emphasis fs-7 mb-0 fst-italic">* Perbarui <span class="fw-medium">data kontak pasien</span> jika terdapat perubahan</p>
            <div class="col-12">
                <label for="patient" class="form-label form-label-sm fs-7">Nomor Rekam Medis <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="patient" id="patient" required>
                    <option value="" selected>x-8-x</option>
                    <option value="12345678">12345678</option>
                    <option value="12345678">12345678</option>
                </select>
            </div>
            <div class="col-12">
                <label for="alamat" class="form-label form-label-sm fs-7">Nama Pasien</label>
                <p class="text-secondary fs-7 mb-0">x-60-x</p>
            </div>
            <div class="col-12">
                <label for="no_hp" class="form-label form-label-sm fs-7">No. HP <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="no_hp" id="no_hp" placeholder="x-15-x" required>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 fs-7">
            <h2 class="text-dark-emphasis fs-6 fw-medium mb-0">Data Domisili</h2>
            <p class="text-dark-emphasis fs-7 mb-0 fst-italic">* Perbarui <span class="fw-medium">data domisili</span> jika terdapat perubahan</p>
            <div class="col-12">
                <label for="alamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control form-control-sm" name="alamat" id="alamat" rows="3" placeholder="x-150-x" required></textarea>
            </div>
            <div class="col-12">
                <label for="rt" class="form-label form-label-sm">RT <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="rt" id="rt" placeholder="x-5-x" required>
            </div>
            <div class="col-12">
                <label for="rw" class="form-label form-label-sm">RW <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="rw" id="rw" placeholder="x-5-x" required>
            </div>
            <div class="col-12">
                <label for="kel_desa" class="form-label form-label-sm">Kelurahan / Desa <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="kel_desa" id="kel_desa" placeholder="x-30-x" required>
            </div>
            <div class="col-12 mb-3">
                <label for="kecamatan" class="form-label form-label-sm">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" placeholder="x-40-x" required>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-sm btn-success">Simpan</button>
    </div>
</div>

<?php
include("views/footer.php");
?>