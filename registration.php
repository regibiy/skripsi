<?php
$title = "Pendaftaran";
include("action.php");

if (isset($_GET['treatmentdate']) && isset($_GET['queuenumber']) && isset($_GET['ruangpoli'])) {
    $treatment_date = decrypt($_GET['treatmentdate']);
    $queue_number = decrypt($_GET['queuenumber']);
    $id_ruang_poli = decrypt($_GET['ruangpoli']);
    $sql = "SELECT * FROM ruang_poli WHERE id_ruang_poli = '$id_ruang_poli'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $nama_ruang_poli = $data['nama_ruang_poli'];
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

$no_kk = $_SESSION['no_kk'];

include("views/header.php");
?>
<div class="mx-3 my-mtb-body">
    <div class="container shadow-sm rounded border py-3">
        <h1 class="text-dark-emphasis fs-6 text-center mb-4">Selesaikan Pendaftaran</h1>
        <p id="alert" class="bg-danger fs-7 py-1 px-2 text-white rounded" style="display: none;"></p>
        <form action="action.php" onsubmit="return validasiPendaftaran()" method="post">
            <div class="d-flex justify-content-between col-12 flex-wrap">
                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 my-gap-6">
                    <h2 class="text-dark-emphasis fs-6 fw-medium mb-0">Data Pendaftaran</h2>
                    <div class="col-12 fs-7">
                        <label class="form-label form-label-sm">Tanggal Daftar</label>
                        <p class="text-secondary mb-0"><?= format_date(Date('Y-m-d')) ?></p>
                        <input type="hidden" name="tanggal_daftar" value="<?= Date('Y-m-d') ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label class="form-label form-label-sm">Nomor Antrian</label>
                        <p class="text-secondary mb-0"><?= $queue_number ?></p>
                        <input type="hidden" name="nomor_antrian" value="<?= $queue_number ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label class="form-label form-label-sm">Tujuan Ruang Poli</label>
                        <p class="text-secondary mb-0"><?= $nama_ruang_poli ?></p>
                        <input type="hidden" name="ruang_poli" value="<?= $id_ruang_poli ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label class="form-label form-label-sm">Tanggal Berobat</label>
                        <p class="text-secondary mb-0"><?= format_date($treatment_date) ?></p>
                        <input type="hidden" name="tanggal_berobat" value="<?= $treatment_date ?>">
                    </div>
                </div>
                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 my-gap-6">
                    <h2 class="text-dark-emphasis fs-6 fw-medium mb-0">Data Kontak Pasien</h2>
                    <p class="text-dark-emphasis fs-7 mb-0 fst-italic">* Perbarui <span class="fw-medium">data kontak pasien</span> jika terdapat perubahan</p>
                    <div class="col-12 fs-7">
                        <label for="patient" class="form-label form-label-sm">Nomor Rekam Medis <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" name="patient" id="patient" required>
                            <option value="---" selected hidden>Pilih pasien yang akan berobat</option>
                            <?php
                            $sql = "SELECT * FROM pasien INNER JOIN rekam_medis ON pasien.nik = rekam_medis.nik WHERE no_kk = '$no_kk' AND status_pasien = 'Dalam KK'";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['no_rekam_medis'] . " " . $row['nama_depan'] . " " . $row['nama_belakang'] . " " . $row['no_hp'] . "'>" . $row['no_rekam_medis'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="alamat" class="form-label form-label-sm">Nama Pasien</label>
                        <p class="text-secondary mb-0" id="patientName"></p>
                        <input type="hidden" name="no_rekam_medis" id="noRekMed">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="no_hp" class="form-label form-label-sm">No. HP <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm" name="no_hp" id="no_hp" autocomplete="off">
                    </div>
                </div>

                <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 fs-7">
                    <h2 class="text-dark-emphasis fs-6 fw-medium mb-0">Data Domisili</h2>
                    <p class="text-dark-emphasis mb-0 fst-italic">* Perbarui <span class="fw-medium">data domisili</span> jika terdapat perubahan</p>
                    <?php
                    $sql = "SELECT * FROM akun WHERE no_kk = '$no_kk'";
                    $result = $conn->query($sql);
                    $data = $result->fetch_assoc();
                    ?>
                    <div class="col-12">
                        <label for="alamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" name="alamat" id="alamat" rows="3" required><?= $data['alamat'] ?></textarea>
                    </div>
                    <div class="col-12">
                        <label for="rt" class="form-label form-label-sm">RT <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="rt" id="rt" value="<?= $data['rt'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="rw" class="form-label form-label-sm">RW <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="rw" id="rw" value="<?= $data['rw'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="kel_desa" class="form-label form-label-sm">Kelurahan / Desa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="kel_desa" id="kel_desa" value="<?= $data['kelurahan_desa'] ?>" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="kecamatan" class="form-label form-label-sm">Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" value="<?= $data['kecamatan'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-sm btn-success" name="simpan_pendaftaran">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php
include("views/footer.php");
?>